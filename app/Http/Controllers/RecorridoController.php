<?php

namespace App\Http\Controllers;

use App\Recorrido;
use Illuminate\Http\Request;
use Validator;

class RecorridoController extends Controller
{
    public function rules(){

        return[
        'costo_economico'=>'required|numeric|min:0',
        'costo_bussiness'=>'required|numeric|min:0',
            'viaje_id' => 'required|numeric|exists:viajes,id'

        ];
    }
        public function rulesPut(){

        return[

        'costo_economico'=>'nullable|numeric|min:0',
        'costo_bussiness'=>'nullable|numeric|min:0',
            'viaje_id' => 'nullable|numeric|exists:viajes,id'

        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Recorrido::all(); //
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
        $recorrido = new \App\Recorrido;
        $recorrido->costo_economico = $request->get('costo_economico');
        $recorrido->costo_bussiness = $request->get('costo_bussiness');
        $recorrido->save();
        return $recorrido;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function show(Recorrido $recorrido)
    {
        $vuelos = $recorrido->recorrido_vuelos()->get();
        $viaje = $recorrido->viaje()->first();
        $cantidad = 0;
        return view('recorrido')->withVuelos($vuelos)->withRecorrido($recorrido)->withViaje($viaje)->withCantidad($cantidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function edit(Recorrido $recorrido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recorrido $recorrido)
    {
       $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $recorrido->update($request->all());

        return $recorrido; //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recorrido $recorrido)
    {
        if($recorrido->es_valido){
            $recorrido->es_valido = false;
            $recorrido->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
