<?php

namespace App\Http\Controllers;

use App\Recorrido;
use Illuminate\Http\Request;
use Validator;

class RecorridoController extends Controller
{
    public function rules(){

        return[
        'costo_economico'=>'required|numeric|min:0',
        'costo_bussiness'=>'required|numeric|min:0',
            'viaje_id' => 'required|numeric|exists:viajes,id'

        ];
    }
        public function rulesPut(){

        return[

        'costo_economico'=>'nullable|numeric|min:0',
        'costo_bussiness'=>'nullable|numeric|min:0',
            'viaje_id' => 'nullable|numeric|exists:viajes,id'

        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Recorrido::all(); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminRecorrido');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),$this->rules());

        if($validator->fails()){
            return $validator->messages();
        }

        $recorrido = Recorrido::create($request->all());


        return $recorrido;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function show(Recorrido $recorrido)
    {
        $vuelos = $recorrido->recorrido_vuelos()->get();
        $viaje = $recorrido->viaje()->first();
        $cantidad = 0;
        return view('recorrido')->withVuelos($vuelos)->withRecorrido($recorrido)->withViaje($viaje)->withCantidad($cantidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function edit(Recorrido $recorrido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recorrido $recorrido)
    {
       $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $recorrido->update($request->all());

        return $recorrido; //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recorrido $recorrido)
    {
        if($recorrido->es_valido){
            $recorrido->es_valido = false;
            $recorrido->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    public function comprar(Recorrido $recorrido){
        return view('economico')->withRecorrido($recorrido);
    }

    public function boleta(Recorrido $recorrido, Request $request){
        try{
            $user = \App\User::where('email',$request->email)->firstOrFail();
        }
        catch(\Exception $e){
            $info = new \Illuminate\Http\Request();
            $info->setMethod('POST');
            $info->request->add([
                'name'=> $request->nombre,
                'apellido'=> $request->apellido,
                'nacionalidad'=> $request->nacionalidad,
                'edad'=> $request->edad,
                'tipoUsuario'=> 0,
                'email'=> $request->email,
                'password'=> "asd123"
            ]);
            $creador = new UserController();
            $user = $creador->store($info);
        }
        if($request->bussiness == "on"){
            $costo = $request->cantidad * $recorrido->costo_bussiness;
        }
        else{
            $costo = $request->cantidad * $recorrido->costo_economico;
        }
        $info = new \Illuminate\Http\Request();
        $info->setMethod('POST');
        $info->request->add([
            'costo' => $costo,
            'seguro' => $request->seguro == "on"
        ]);
        $creador = new ReservaController();
        $reserva = $creador->store($info);
        $vuelos = $recorrido->recorrido_vuelos()->get();
        return view('boleta')
            ->withRequest($request)
            ->withRecorrido($recorrido)
            ->withCosto($costo)
            ->withVuelos($vuelos)
            ->withUser($user)
            ->withReserva($reserva);
    }
}
