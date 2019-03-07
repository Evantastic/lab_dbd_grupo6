<?php

namespace App\Http\Controllers;

use \App\Compra;
use \App\Recorrido;
use \App\User;
use \App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Carbon\Carbon;
use App\Mail\OrderShipped;
use Auth;
class CompraController extends Controller
{
    public function rulesPost(){
        return [
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'user_id' => 'required|numeric|exists:users,id',
            'medio_pago' =>'required|integer|between:1,3'
        ];
    }

    public function rulesPut(){
        return [
            'reserva_id' => 'nullable|numeric|exists:reservas,id',
            'user_id' => 'nullable|numeric|exists:users,id',
            'medio_pago' =>'nullable|integer|between:1,3'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Compra::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rulesPost());
        if($validator->fails()){
            return $validator->messages();
        }

        $compra = Compra::create($request->all());
        try{
          Mail::to(Auth::user()->email)->send(new OrderShipped($compra));
        }
        catch(\Exception $e){
          Mail::to($compra->user()->first()->email)->send(new OrderShipped($compra));
        }
        return $compra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        return $compra;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $compra->update($request->all());

        return $compra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        if($compra->es_valido){
            $compra->es_valido = false;
            $compra->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    private function ask(Recorrido $recorrido, Request $request){
        $bussiness = $request->bussiness == "on";
        $valido = true;
        foreach ($recorrido->recorrido_vuelos()->get() as $vuelo){
            $v = $vuelo->vuelo()->first();
            $size = $bussiness ? $v->capacidad_bussiness : $v->capacidad_economica;
            if($size - $request->cantidad < 0){
                $valido = false;
            }
        }
        return $valido;
    }

    private function confirm(Recorrido $recorrido, Request $request){
        $bussiness = $request->bussiness == "on";
        $controller = new VueloController();
        foreach ($recorrido->recorrido_vuelos()->get() as $vuelo){
            $v = $vuelo->vuelo()->first();
            $size = $bussiness ? $v->capacidad_bussiness : $v->capacidad_economica;
            $info = new \Illuminate\Http\Request();
            $info->setMethod('PUT');
            if($bussiness){
                $info->request->add([
                    'capacidad_bussiness' => $size - $request->cantidad
                ]);
            }
            else{
                $info->request->add([
                    'capacidad_economica' => $size - $request->cantidad
                ]);
            }
            $controller->update($info,$v);
        }
    }

    private function crearPasajes(Recorrido $recorrido, Request $request, Reserva $reserva){
        $pasajes = array();
        $controller = new PasajeController();
        foreach ($recorrido->recorrido_vuelos()->get() as $v){
            $vuelo = $v->vuelo()->first();
            for ($i = 1; $i <= $request->cantidad; $i++){
                $info = new \Illuminate\Http\Request();
                $info->setMethod('POST');
                $info->request->add([
                    'fila'=> 'X',
                    'columna'=> 100,
                    'pasaje_simple'=> true,
                    'asiento_bussiness'=> $request->bussiness == "on",
                    'asiento_discapacidad'=> false,
                    'reserva_id'=> $reserva->id,
                    'vuelo_id'=> $vuelo->id
                ]);
                $pasajes[] = $controller->store($info);
            }
        }
        return $pasajes;
    }

    private function crearRR(Recorrido $recorrido, Reserva $reserva, Request $request){
        $controller = new RecorridoReservaController();
        $info = new \Illuminate\Http\Request();
        $info->setMethod('POST');
        $info->request->add([
            'recorrido_id'    => $recorrido->id,
            'reserva_id'      => $reserva->id,
            'costo_economico' => $recorrido->costo_economico * $request->cantidad,
            'costo_bussiness' => $recorrido->costo_bussiness * $request->cantidad
        ]);
        return $controller->store($info);
    }

    private function crearCompra(Reserva $reserva, User $user,Request $request){
        $info = new \Illuminate\Http\Request();
        $info->setMethod('POST');
        $info->request->add([
            'reserva_id' => $reserva->id,
            'user_id' => $user->id,
            'medio_pago' => $request->medio
        ]);
        return $this->store($info);
    }

    public function confirmar(Recorrido $recorrido, User $user, Reserva $reserva, Request $request){
        $valido = $this->ask($recorrido,$request);
        if($valido){
            $this->confirm($recorrido,$request);
            $pasajes = $this->crearPasajes($recorrido, $request, $reserva);
            $this->crearRR($recorrido,$reserva,$request);
            $compra = $this->crearCompra($reserva,$user,$request);

            return view('compra')->withCompra($compra)->withRecorrido($recorrido)->withUser($user)->withPasajes($pasajes);
            return $compra;
        }
        else{
            return "no";
        }
    }

    public function checkin(Request $request){
      $error404 = false;
      $errorCheckeada = false;
      try{
        $compra = Compra::findOrFail($request->compra);
        if($compra->checkeada){
          $errorCheckeada = true;
        }
        else{
          $compra->checkeada = true;
          $compra->save();
        }
      }
      catch(\Exception $e){
        $error404 = true;;
      }
      return view('checkin')->withError404($error404)->withErrorCheckeada($errorCheckeada);
    }
}
