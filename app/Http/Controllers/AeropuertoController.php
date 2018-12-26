<?php

namespace App\Http\Controllers;

use App\Aeropuerto;
use Illuminate\Http\Request;
use Validator;

class AeropuertoController extends Controller
{
    public function rules(){
        return  [
            'ciudad_id' => 'required|numeric|exists:ciudades,id',
            'nombre' => 'required|string|max:128',
            'direccion' => 'required|string|max:64'
        ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Aeropuerto::all();
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
        
        $aeropuerto = new \App\Aeropuerto;
        $aeropuerto->nombre = $request->get('nombre');
        $aeropuerto->direccion = $request->get('direccion');
        $aeropuerto->ciudad_id = $request->get('ciudad_id');
        $aeropuerto->save();
        return $aeropuerto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function show(Aeropuerto $aeropuerto)
    {
        return $aeropuerto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function edit(Aeropuerto $aeropuerto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aeropuerto $aeropuerto)
    {
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return json_encode(['outcome' => 'error']); 
        }
        
        $aeropuerto->nombre = $request->get('nombre');
        $aeropuerto->direccion = $request->get('direccion');
        $aeropuerto->ciudad_id = $request->get('ciudad_id');
        $aeropuerto->save();
        return $aeropuerto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aeropuerto $aeropuerto)
    {
        if($aeropuerto->es_valido){
            $aeropuerto->es_valido = false;
            $aeropuerto->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
