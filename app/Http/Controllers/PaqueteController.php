<?php

namespace App\Http\Controllers;

use App\User;
use App\Reserva;
use App\Vehiculo;
use App\Habitacion;
use App\Recorrido;

use App\Paquete;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class PaqueteController extends Controller
{
    public function rulesPost(){
        return [
        'recorrido_id' => 'required|numeric|exists:recorridos,id',
        'habitacion_id' => 'required|numeric|exists:habitaciones,id',
        'vehiculo_id' => 'required|numeric|exists:vehiculos,id',
        'descuento' => 'required|numeric',
        'tipo' => 'required|numeric',
        'cantidad_personas' => 'required|numeric',
        'fecha_expiracion' => 'required|date'
        ];
    }

    public function rulesPut(){
        return [
        'recorrido_id' => 'nullable|numeric|exists:recorridos,id',
        'habitacion_id' => 'nullable|numeric|exists:habitaciones,id',
        'vehiculo_id' => 'nullable|numeric|exists:vehiculos,id',
        'descuento' => 'nullable|numeric',
        'tipo' => 'nullable|numeric',
        'cantidad_personas' => 'nullable|numeric',
        'fecha_expiracion' => 'nullable|date'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquetes = Paquete::all();
        return view('paquete')->withPaquetes($paquetes);
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

        $paquete = Paquete::create($request->all());

        return $paquete;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function show(Paquete $paquete)
    {
      $vehiculo = $paquete->vehiculo()->first();
      $hotel = $paquete->habitacion()->first()->hotel()->first();
      $recorrido = $paquete->recorrido()->first();
      return view('paqueteSingular')->withPaquete($paquete)->withHotel($hotel)->withAuto($vehiculo)->withRecorrido($recorrido);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete $paquete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paquete $paquete)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $paquete->update($request->all());

        return $paquete;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paquete $paquete)
    {
        if($paquete->es_valido){
            $paquete->es_valido = false;
            $paquete->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    public function compra(Paquete $paquete){
      return view('comprarPaquete')->withPaquete($paquete);
    }

    public function boleta(Paquete $paquete, Request $request){
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
          'password'=> bcrypt('asd123')
        ]);
        $creador = new UserController();
        $user = $creador->store($info);
      }
      $vehiculo = $paquete->vehiculo()->first();
      $habitacion = $paquete->habitacion()->first();
      $recorrido = $paquete->recorrido()->first();
      $descuento = $paquete->descuento / 100;
      if($request->bussiness == "on"){
        $costoRecorrido = $paquete->cantidad_personas * $recorrido->costo_bussiness * $descuento;
      }
      else{
        $costoRecorrido = $paquete->cantidad_personas * $recorrido->costo_economico * $descuento;
      }
      $fechaInicio = Carbon::parse($request->fecha_inicio);
      $fechaTermino = Carbon::parse($request->fecha_termino);
      $days = $fechaTermino->diffInDays($fechaInicio);
      $costoHabitacion = $habitacion->precio * $days * $descuento;
      $costoHabitacion;
      $costoVehiculo = $vehiculo->precio * $days * $descuento;
      $costoVehiculo;
      $costoTotal = $costoVehiculo + $costoRecorrido + $costoHabitacion;
      $info = new \Illuminate\Http\Request();
      $info->setMethod('POST');
      $info->request->add([
        'costo' => (int)$costoTotal,
        'seguro' => $request->seguro == "on"
      ]);
      $creador = new ReservaController();
      $reserva = $creador->store($info);
      $vuelos = $recorrido->recorrido_vuelos()->get();
      return view('boletaPaquete')
      ->withRequest($request)
      ->withRecorrido($recorrido)
      ->withCostoTotal($costoTotal)
      ->withCostoVehiculo($costoVehiculo)
      ->withCostoRecorrido($costoRecorrido)
      ->withCostoHabitacion($costoHabitacion)
      ->withDays($days)
      ->withUser($user)
      ->withVuelos($vuelos)
      ->withReserva($reserva)
      ->withPaquete($paquete)
      ->withVehiculo($vehiculo)
      ->withHabitacion($habitacion);
    }

    private function ask(Recorrido $recorrido, Request $request, $cantidad){
        $bussiness = $request->bussiness == "on";
        $valido = true;
        foreach ($recorrido->recorrido_vuelos()->get() as $vuelo){
            $v = $vuelo->vuelo()->first();
            $size = $bussiness ? $v->capacidad_bussiness : $v->capacidad_economica;
            if($size - $cantidad < 0){
                $valido = false;
            }
        }
        return $valido;
    }

    private function confirm(Recorrido $recorrido, Request $request, $cantidad){
        $bussiness = $request->bussiness == "on";
        $controller = new VueloController();
        foreach ($recorrido->recorrido_vuelos()->get() as $vuelo){
            $v = $vuelo->vuelo()->first();
            $size = $bussiness ? $v->capacidad_bussiness : $v->capacidad_economica;
            $info = new \Illuminate\Http\Request();
            $info->setMethod('PUT');
            if($bussiness){
                $info->request->add([
                    'capacidad_bussiness' => $size - $cantidad
                ]);
            }
            else{
                $info->request->add([
                    'capacidad_economica' => $size - $cantidad
                ]);
            }
            $controller->update($info,$v);
        }
    }

    private function crearPasajes(Recorrido $recorrido, Request $request, Reserva $reserva, $cantidad){
        $pasajes = array();
        $controller = new PasajeController();
        foreach ($recorrido->recorrido_vuelos()->get() as $v){
            $vuelo = $v->vuelo()->first();
            for ($i = 1; $i <= $cantidad; $i++){
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

    private function crearRR(Recorrido $recorrido, Reserva $reserva, Request $request, $cantidad){
        $controller = new RecorridoReservaController();
        $info = new \Illuminate\Http\Request();
        $info->setMethod('POST');
        $info->request->add([
            'recorrido_id'    => $recorrido->id,
            'reserva_id'      => $reserva->id,
            'costo_economico' => $recorrido->costo_economico * $cantidad,
            'costo_bussiness' => $recorrido->costo_bussiness * $cantidad
        ]);
        return $controller->store($info);
      }

    private function crearRV(Vehiculo $v, Reserva $rs, Request $r, $cantidad){
      $controller = new ReservaVehiculoController();
      $info = new \Illuminate\Http\Request();
      $info->setMethod('POST');
      $info->request->add([
          'vehiculo_id'    => $v->id,
          'reserva_id'      => $rs->id,
          'precio' => $r->costoVehiculo,
          'fecha_inicio' => $r->fecha_inicio,
          'fecha_termino' => $r->fecha_termino
      ]);
      return $controller->store($info);
    }

    private function crearHR(Habitacion $h, Reserva $rs, Request $r, $cantidad){
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

    public function confirmar(Paquete $paquete, User $user, Reserva $reserva, Vehiculo $vehiculo, Habitacion $habitacion, Recorrido $recorrido, Request $request){
      $p = $paquete;
      $u = $user;
      $rs = $reserva;
      $v = $vehiculo;
      $h = $habitacion;
      $rc = $recorrido;
      $r = $request;
      $valido = $this->ask($rc,$r, $p->cantidad_personas);
      if($valido){
          $this->confirm($rc,$r, $p->cantidad_personas);
          $pj = $this->crearPasajes($rc, $r, $rs, $p->cantidad_personas);
          $this->crearRR($rc,$rs,$r,$p->cantidad_personas);
          $this->crearRV($v,$rs,$r,$p->cantidad_personas);
          $this->crearHR($h,$rs,$r,$p->cantidad);
          $c = $this->crearCompra($rs,$u,$r);
          return view('compraPaquete')
          ->withC($c)
          ->withRc($rc)
          ->withU($u)
          ->withPj($pj)
          ->withH($h)
          ->withV($v)
          ->withP($p);
      }
      else{
          return "no";
      }
    }
}
