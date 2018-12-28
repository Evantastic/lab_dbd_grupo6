<?php

namespace App\Http\Controllers;

use App\Paquete;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class PaqueteController extends Controller
{
    public function rules(){
        return [
        'recorrido_id' => 'required|numeric|exists:recorridos,id',
        'habitacion_id' => 'required|numeric|exists:habitaciones,id',
        'vehiculo_id' => 'required|numeric|exists:vehiculos,id',
        'descuento' => 'required|numeric',
        'tipo' => 'required|numeric',
        'cantidad_personas' => 'required|numeric',
        'fecha_expiracion' => 'required|string'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Paquete::all();
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
        $paquete = new \App\Paquete;
        $paquete->recorrido_id = $request->get('recorrido_id'); 
        $paquete->habitacion_id = $request->get('habitacion_id');
        $paquete->vehiculo_id = $request->get('vehiculo_id');
        $paquete->descuento = $request->get('descuento');
        $paquete->tipo = $request->get('tipo');
        $paquete->cantidad_personas = $request->get('cantidad_personas');
        try{
            $tiempo = Carbon::createFromFormat('d/m/Y', $request->get('fecha_expiracion'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $paquete->fecha_expiracion = $tiempo;
        $paquete->save();
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
        return $paquete;
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
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $paquete->recorrido_id = $request->get('recorrido_id'); 
        $paquete->habitacion_id = $request->get('habitacion_id');
        $paquete->vehiculo_id = $request->get('vehiculo_id');
        $paquete->descuento = $request->get('descuento');
        $paquete->tipo = $request->get('tipo');
        $paquete->cantidad_personas = $request->get('cantidad_personas');
        try{
            $tiempo = Carbon::createFromFormat('d/m/Y', $request->get('fecha_expiracion'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $paquete->fecha_expiracion = $tiempo;
        $paquete->save();
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
