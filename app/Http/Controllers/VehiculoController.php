<?php

namespace App\Http\Controllers;

use Validator;
use App\Vehiculo;
use Illuminate\Http\Request;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehiculo::all();
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
        $vehiculo = new \App\Vehiculo;
        $vehiculo->automotora_id = $request->get('automotora_id');
        $vehiculo->marca         = $request->get('marca');
        $vehiculo->modelo        = $request->get('modelo');
        $vehiculo->tipo          = $request->get('tipo');
        $vehiculo->patente       = $request->get('patente');
        $vehiculo->precio        = $request->get('precio');
        $vehiculo->capacidad     = $request->get('capacidad');
        $vehiculo->save();
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
        return $vehiculo;
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
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $vehiculo->automotora_id = $request->get('automotora_id');
        $vehiculo->marca         = $request->get('marca');
        $vehiculo->modelo        = $request->get('modelo');
        $vehiculo->tipo          = $request->get('tipo');
        $vehiculo->patente       = $request->get('patente');
        $vehiculo->precio        = $request->get('precio');
        $vehiculo->capacidad     = $request->get('capacidad');
        $vehiculo->save();
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
}
