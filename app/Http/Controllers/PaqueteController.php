<?php

namespace App\Http\Controllers;

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
}
