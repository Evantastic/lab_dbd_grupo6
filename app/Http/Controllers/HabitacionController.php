<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function rules(){
        return [
            'hotel_id' => 'required|numeric|exists:hoteles,id',
            'numero_habitacion' => 'required|numeric',
            'capacidad' => 'required|numeric',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Habitacion::all();
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
        $validator = Validator::make($request->all(),
                                     $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $habitacion = new \App\Habitacion;
        $habitacion->hotel_id = $request->get('hotel_id');
        $habitacion->numero_habitacion = $request->get('numero_habitacion');
        $habitacion->capacidad = $request->get('capacidad');
        $habitacion->descripcion = $request->get('descripcion');
        $habitacion->precio = $request->get('precio');
        $habitacion->save();
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
        return $habitacion;
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
        $validator = Validator::make($request->all(),
                                     $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $habitacion->hotel_id = $request->get('hotel_id');
        $habitacion->numero_habitacion = $request->get('numero_habitacion');
        $habitacion->capacidad = $request->get('capacidad');
        $habitacion->descripcion = $request->get('descripcion');
        $habitacion->precio = $request->get('precio');
        $habitacion->save();
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
}
