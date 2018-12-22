<?php

namespace App\Http\Controllers;

use Validator;
use App\Viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function rules(){
        return [
            'ciudad_origen_id' => 'required|numeric|exists:ciudades,id',
            'ciudad_destino_id' => 'required|numeric|exists:ciudades,id|different:ciudad_origen_id',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Viaje::all(); 
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
        $viaje = new \App\Viaje;
        $viaje->ciudad_origen_id = $request->get('ciudad_origen_id');
        $viaje->ciudad_destino_id = $request->get('ciudad_destino_id');
        $viaje->save();
        return $viaje;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
        return $viaje;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Viaje $viaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viaje $viaje)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $viaje->ciudad_origen_id = $request->get('ciudad_origen_id');
        $viaje->ciudad_destino_id = $request->get('ciudad_destino_id');
        $viaje->save();
        return $viaje;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viaje $viaje)
    {
        if($viaje->es_valido){
            $viaje->es_valido = false;
            $viaje->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
