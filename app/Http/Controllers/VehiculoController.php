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
}
