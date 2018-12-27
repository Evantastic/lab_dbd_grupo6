<?php

namespace App\Http\Controllers;

use App\Paquete;
use Illuminate\Http\Request;
use Validator;

class PaqueteController extends Controller
{
    public function rules(){
        return [
        'recorrido_id' => 'required|numeric|exists:recorridos,id',
        'habitacion_id' => 'required|numeric|exists:habitaciones,id',
        'vehiculo_id' => 'required|numeric|vehiculos,id',
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
        'vehiculo_id'
        'descuento'
        'tipo'
        'cantidad_personas'
        'fecha_expiracion'
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paquete $paquete)
    {
        //
    }
}
