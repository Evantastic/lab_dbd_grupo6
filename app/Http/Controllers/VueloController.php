<?php

namespace App\Http\Controllers;

use App\Vuelo;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;

class VueloController extends Controller
{
    public function rulesPost(){
        return [
            'aeropuerto_origen_id' => 'required|numeric|exists:aeropuertos,id',
            'aeropuerto_destino_id' => 'required|numeric|exists:aeropuertos,id|different:aeropuerto_origen_id',
            'capacidad_economica' => 'required|numeric',
            'capacidad_bussiness' => 'required|numeric',
            'capacidad_discapacidad_bussiness' => 'required|numeric',
            'capacidad_discapacidad_economica' => 'required|numeric',
            'tiempo_salida' => 'required|date',
            'tiempo_llegada' => 'required|date|different:tiempo_salida',
            'patente' => 'required|string|max:16'
        ];
    }

    public function rulesPut(){
        return [
            'aeropuerto_origen_id' => 'nullable|numeric|exists:aeropuertos,id',
            'aeropuerto_destino_id' => 'nullable|numeric|exists:aeropuertos,id|different:aeropuerto_origen_id',
            'capacidad_economica' => 'nullable|numeric',
            'capacidad_bussiness' => 'nullable|numeric',
            'capacidad_discapacidad_bussiness' => 'nullable|numeric',
            'capacidad_discapacidad_economica' => 'nullable|numeric',
            'tiempo_salida' => 'nullable|date',
            'tiempo_llegada' => 'nullable|date|different:tiempo_salida',
            'patente' => 'nullable|string|max:16'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vuelo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminVuelo');
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
        //$request->tiempo_salida = Carbon::createFromFormat('m-d-Y h:i A', $request->tiempo_salida);
        //$request->tiempo_origen = Carbon::createFromFormat('m-d-Y h:i A', $request->tiempo_origen);
        //$request->tiempo_salida = $request->tiempo_salida->format('d-m-Y h:i:s');
        //$request->tiempo_origen = $request->tiempo_origen->format('d-m-Y h:i:s');

        $vuelo = Vuelo::create($request->all());

        return $vuelo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function show(Vuelo $vuelo)
    {
        return $vuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vuelo $vuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vuelo $vuelo)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $vuelo->update($request->all());

        return $vuelo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vuelo $vuelo)
    {
        if($vuelo->es_valido){
            $vuelo->es_valido = false;
            $vuelo->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    public function busqueda(Request $request) {
      /*
      * "nombre_ciudad_origen": "South Leonora"
      * "nombre_ciudad_destino": "Port Norwoodville"
      * "fecha_inicio": "2008-07-30"
      * "cantidad": "3"
      */
      $ciudadOrigen = DB::table('ciudades')->where('nombre',$request->nombre_ciudad_origen)->first();
      $ciudadDestino = DB::table('ciudades')->where('nombre',$request->nombre_ciudad_destino)->first();
      $viaje = DB::table('viajes')
        ->where('ciudad_origen_id', $ciudadOrigen->id)
        ->where('ciudad_destino_id',$ciudadDestino->id)
        ->first();
      $fecha = Carbon::parse($request->fecha_inicio);
      $baneados = array();
      foreach ($viaje->recorridos()->get() as $recorrido) {
        $vuelos = $recorrido->recorrido_vuelos()->get();
        $fechasSalidas = array();
        foreach ($vuelos as $vuelo) {
          $fechasSalidas[] = $Carbon::parse($vuelo->tiempo_salida);
        }
        $min = min($fechasSalidas);
        if(count($fechasSalidas) == 0){
          $baneados[] = $recorrido->id;
        }
        elseif (!$fecha->between($min->subDay(),$min->addDay())) {
          $baneados[] = $recorrido->id;
        }
        else {
          foreach ($vuelos as $vuelo) {
            if ($vuelo->capacidad_economica < $request->cantidad &&
                $vuelo->capacidad_bussiness < $request->cantidad) {
                  $baneados[] = $recorrido->id;
                }
            exit;
          }
        }
      }
      $recorridosFinales = array();
      foreach ($viaje->recorridos()->get() as $recorrido) {
        if( !in_array($recorrido->id, $baneados)) {
          $recorridosFinales[] = $recorrido;
        }
      }
      return $recorridosFinales;
    }
}
