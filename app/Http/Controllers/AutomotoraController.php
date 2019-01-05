<?php

namespace App\Http\Controllers;

use Validator;
use App\Automotora;
use Illuminate\Http\Request;

class AutomotoraController extends Controller
{
    public function rulesPost(){
        return [
            'ciudad_id' => 'required|numeric|exists:ciudades,id',
            'direccion' => 'required|string|max:128',
            'nombre' => 'required|string|max:64'
        ];
    }

    public function rulesPut(){
        return [
            'ciudad_id' => 'nullable|numeric|exists:ciudades,id',
            'direccion' => 'nullable|string|max:128',
            'nombre' => 'nullable|string|max:64'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Automotora::all();
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

        $automotora = Automotora::create($request->all());
        
        return $automotora;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Automotora  $automotora
     * @return \Illuminate\Http\Response
     */
    public function show(Automotora $automotora)
    {
        return $automotora;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Automotora  $automotora
     * @return \Illuminate\Http\Response
     */
    public function edit(Automotora $automotora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Automotora  $automotora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Automotora $automotora)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $automotora->update($request->all());
        
        return $automotora;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Automotora  $automotora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Automotora $automotora)
    {
        if($automotora->es_valido){
            $automotora->es_valido = false;
            $automotora->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
