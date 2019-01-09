<?php

namespace App\Http\Controllers;

use Validator;
use App\Recorrido_Reserva;
use Illuminate\Http\Request;

class RecorridoReservaController extends Controller
{
    public function rules(){
        return [
            'recorrido_id'    => 'required|numeric|exists:recorridos,id',
            'reserva_id'      => 'required|numeric|exists:reservas,id',
            'costo_economico' => 'required|numeric',
            'costo_bussiness' => 'required|numeric'
        ];
    }
    public function rulePut(){
        return [
            'recorrido_id'    => 'nullable|numeric|exists:recorridos,id',
            'reserva_id'      => 'nullable|numeric|exists:reservas,id',
            'costo_economico' => 'nullable|numeric',
            'costo_bussiness' => 'nullable|numeric'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Recorrido_Reserva::all();
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
        $recorrido_reserva = Recorrido_Reserva::create($request->all());
        
        return $recorrido_reserva;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\recorrido_reserva  $recorrido_reserva
     * @return \Illuminate\Http\Response
     */
    public function show(recorrido_reserva $recorrido_reserva)
    {
        return $recorrido_reserva;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\recorrido_reserva  $recorrido_reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(recorrido_reserva $recorrido_reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\recorrido_reserva  $recorrido_reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recorrido_reserva $recorrido_reserva)
    {
        $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $recorrido_reserva->update($request->all())
        return $recorrido_reserva;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\recorrido_reserva  $recorrido_reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(recorrido_reserva $recorrido_reserva)
    {
        if($recorrido_reserva->es_valido){
            $recorrido_reserva->es_valido = false;
            $recorrido_reserva->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
