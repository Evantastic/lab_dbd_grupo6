<?php

namespace App\Http\Controllers;

use Validator;
use App\Vehiculo;
use App\User;
use App\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class VehiculoController extends Controller
{
    public function rules(){
        return [
            'automotora_id' => 'required|numeric|exists:automotoras,id',
            'marca' => 'required|string|max:32',
            'modelo' => 'required|string|max:32',
            'tipo' => 'required|string|max:32',
            'patente' => 'required|alpha_num|max:16',
            'precio' => 'required|numeric',
            'capacidad' => 'required|numeric|between:1,5'
        ];
    }
        public function rulesPut(){
        return [
            'automotora_id' => 'nullable|numeric|exists:automotoras,id',
            'marca' => 'nullable|string|max:32',
            'modelo' => 'nullable|string|max:32',
            'tipo' => 'nullable|string|max:32',
            'patente' => 'nullable|alpha_num|max:16',
            'precio' => 'nullable|numeric',
            'capacidad' => 'nullable|numeric|between:1,5'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculos')->withVehiculos($vehiculos);
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
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $vehiculo = Vehiculo::create($request->all());

        return $vehiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculo')->withVehiculos($vehiculo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $vehiculo->update($request->all());
        return $vehiculo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        if($vehiculo->es_valido){
            $vehiculo->es_valido = false;
            $vehiculo->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    public function compra(Vehiculo $vehiculo){
      return view('comprarVehiculo')->withVehiculo($vehiculo);
    }

    public function boleta(Vehiculo $vehiculo, Request $request){
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
      $costo = $vehiculo->precio * $days;
      $info = new \Illuminate\Http\Request();
      $info->setMethod('POST');
      $info->request->add([
          'costo' => $costo,
          'seguro' => $request->seguro == "on"
      ]);
      $creador = new ReservaController();
      $reserva = $creador->store($info);
      return view('boletaVehiculo')
      ->withVehiculo($vehiculo)
      ->withRequest($request)
      ->withUser($user)
      ->withReserva($reserva)
      ->withDays($days);
    }

    private function crearRV(Vehiculo $v, Reserva $rs, Request $r){
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

    public function confirmar(Vehiculo $vehiculo, User $user, Reserva $reserva, Request $request){
      $this->crearRV($vehiculo,$reserva,$request);
      $compra = $this->crearCompra($reserva,$user,$request);
      return view('confirmarVehiculo')->withCompra($compra)->withUser($user)->withVehiculo($vehiculo);
    }

    public function busqueda(Request $request){
      //'nombre_ciudad': 'South Leonora'
      //'fecha_inicio': '2012-12-09'
      //'fecha_termino': '2012-12-13'
      $ciudad = DB::table('ciudades')->where('nombre',$request->nombre_ciudad)->first();
      $info = DB::table('reserva_vehiculos')
        ->join('vehiculos', 'reserva_vehiculos.vehiculo_id', '=', 'vehiculos.id')
        ->join('automotoras', 'vehiculos.automotora_id', '=', 'automotoras.id')
        ->join('ciudades', 'automotoras.ciudad_id', '=', 'ciudades.id')
        ->where('ciudad_id',$ciudad->id)
        ->select('vehiculo_id', 'fecha_inicio', 'fecha_termino')
        ->get();
      $fechaInicio = Carbon::parse($request->fecha_inicio);
      $fechaTermino = Carbon::parse($request->fecha_termino);
      $baneados = array();
      foreach ($info as $reserva) {
        $fechaInicioReserva = Carbon::parse($reserva->fecha_inicio);
        $fechaTerminoReserva = Carbon::parse($reserva->fecha_termino);
        if($fechaInicio->between($fechaInicioReserva,$fechaTerminoReserva)
          || $fechaTermino->between($fechaInicioReserva,$fechaTerminoReserva)){
          $baneados[] = $reserva->vehiculo_id;
        }
      }
      $vehiculos = DB::table('vehiculos')
        ->join('automotoras', 'vehiculos.automotora_id', '=', 'automotoras.id')
        ->join('ciudades', 'automotoras.ciudad_id', '=', 'ciudades.id')
        ->where('ciudad_id',$ciudad->id)
        ->select('vehiculos.*')
        ->get();
      $vehiculosFinales = array();
      foreach($vehiculos as $vehiculo) {
        if( !in_array($vehiculo->id, $baneados) ) {
          $vehiculosFinales[] = $vehiculo;
        }
      }
      return view('vehiculos')->withVehiculos($vehiculosFinales);
    }
}
