<?php

namespace App\Http\Controllers;

use App\Vuelo;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class VueloController extends Controller
{
    public function rules(){
        return [
            'aeropuerto_origen_id' => 'required|numeric|exists:aeropuertos,id',
            'aeropuerto_destino_id' => 'required|numeric|exists:aeropuertos,id|different:aeropuerto_origen_id',
            'capacidad_economica' => 'required|numeric',
            'capacidad_business' => 'required|numeric',
            'capacidad_discapacidad_bussiness' => 'required|numeric',
            'capacidad_discapacidad_economica' => 'required|numeric',
            'tiempo_salida' => 'required|string',
            'tiempo_llegada' => 'required|string|different:tiempo_salida',
            'patente' => 'required|string|max:16'
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
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $vuelo = new \App\Vuelo;
        $vuelo->aeropuerto_origen_id = $request->get('aeropuerto_origen_id');
        $vuelo->aeropuerto_destino_id = $request->get('aeropuerto_destino_id');
        $vuelo->capacidad_economica = $request->get('capacidad_economica');
        $vuelo->capacidad_business = $request->get('capacidad_business');
        $vuelo->capacidad_discapacidad_bussiness = $request->get('capacidad_discapacidad_bussiness');
        $vuelo->capacidad_discapacidad_economica = $request->get('capacidad_discapacidad_economica');
        try{
            $tiempo1 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('tiempo_salida'));
            $tiempo2 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('tiempo_llegada'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $vuelo->tiempo_salida = $tiempo1;
        $vuelo->tiempo_llegada = $tiempo2;
        $vuelo->patente = $request->get('patente');
        $vuelo->save();
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
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $vuelo->aeropuerto_origen_id = $request->get('aeropuerto_origen_id');
        $vuelo->aeropuerto_destino_id = $request->get('aeropuerto_destino_id');
        $vuelo->capacidad_economica = $request->get('capacidad_economica');
        $vuelo->capacidad_business = $request->get('capacidad_business');
        $vuelo->capacidad_discapacidad_bussiness = $request->get(
            'capacidad_discapacidad_bussiness');
        $vuelo->capacidad_discapacidad_economica = $request->get('capacidad_discapacidad_economica');
        try{
            $tiempo1 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('tiempo_salida'));
            $tiempo2 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('tiempo_llegada'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $vuelo->tiempo_salida = $tiempo1;
        $vuelo->tiempo_llegada = $tiempo2;
        $vuelo->patente = $request->get('patente');
        $vuelo->save();
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
}
