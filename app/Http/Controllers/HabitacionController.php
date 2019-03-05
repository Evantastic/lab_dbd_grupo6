<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion;
use App\Reserva;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HabitacionController extends Controller
{
    public function rulesPost(){
        return [
            'hotel_id' => 'required|numeric|exists:hoteles,id',
            'numero_habitacion' => 'required|numeric',
            'capacidad' => 'required|numeric',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric'
        ];
    }

    public function rulesPut(){
        return [
            'hotel_id' => 'nullable|numeric|exists:hoteles,id',
            'numero_habitacion' => 'nullable|numeric',
            'capacidad' => 'nullable|numeric',
            'descripcion' => 'nullable|string',
            'precio' => 'nullable|numeric'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('habitaciones')->withHabitaciones($habitaciones);
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

        $habitacion = Habitacion::create($request->all());

        return $habitacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Habitacion $habitacion)
    {
        return view('habitacion')->withHabitacion($habitacion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacion $habitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitacion $habitacion)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $habitacion->update($request->all());
        return $habitacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacion $habitacion)
    {
        if($habitacion->es_valido){
            $habitacion->es_valido = false;
            $habitacion->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    public function compra(Habitacion $habitacion){
      return view('comprarHabitacion')->withHabitacion($habitacion);
    }

    public function boleta(Habitacion $habitacion, Request $request){
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
      $fechaInicio = Carbon::parse($request->fecha_inicio);
      $fechaTermino = Carbon::parse($request->fecha_termino);
      $days = $fechaTermino->diffInDays($fechaInicio);
      $costo = $habitacion->precio * $days;
      $info = new \Illuminate\Http\Request();
      $info->setMethod('POST');
      $info->request->add([
          'costo' => $costo,
          'seguro' => $request->seguro == "on"
      ]);
      $creador = new ReservaController();
      $reserva = $creador->store($info);
      return view('boletaHabitacion')
      ->withHabitacion($habitacion)
      ->withRequest($request)
      ->withUser($user)
      ->withReserva($reserva)
      ->withDays($days);
    }

    private function crearHR(Habitacion $h, Reserva $rs, Request $r){
      $controller = new HabitacionReservaController();
      $info = new \Illuminate\Http\Request();
      $info->setMethod('POST');
      $info->request->add([
          'habitacion_id'    => $h->id,
          'reserva_id'      => $rs->id,
          'precio' => $r->costoHabitacion,
          'fecha_inicio' => $r->fecha_inicio,
          'fecha_termino' => $r->fecha_termino
      ]);
      return $controller->store($info);
    }

    private function crearCompra(Reserva $reserva, User $user,Request $request){
      $controller = new CompraController();
        $info = new \Illuminate\Http\Request();
        $info->setMethod('POST');
        $info->request->add([
            'reserva_id' => $reserva->id,
            'user_id' => $user->id,
            'medio_pago' => $request->medio
        ]);
        return $controller->store($info);
    }

    public function confirmar(Habitacion $habitacion, User $user, Reserva $reserva, Request $request){
      $this->crearHR($habitacion,$reserva,$request);
      $compra = $this->crearCompra($reserva,$user,$request);
      return view('confirmarHabitacion')->withCompra($compra)->withUser($user)->withHabitacion($habitacion);
    }
}
