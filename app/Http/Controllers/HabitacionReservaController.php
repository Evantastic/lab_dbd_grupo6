<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion_Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HabitacionReservaController extends Controller
{
    public function rulesPost(){
        return [
            'habitacion_id' => 'required|numeric|exists:habitaciones,id',
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'precio' => 'required|numeric',
            'fecha_inicio' => 'required|string',
            'fecha_termino' => 'required|string'
        ];
    }

    public function rulesPut(){
        return [
            'habitacion_id' => 'nullable|numeric|exists:habitaciones,id',
            'reserva_id' => 'nullable|numeric|exists:reservas,id',
            'precio' => 'nullable|numeric',
            'fecha_inicio' => 'nullable|string',
            'fecha_termino' => 'nullable|string'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Habitacion_Reserva::all();
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
        $validator = Validator::make($request->all(),$this->rulesPost());
        if($validator->fails()){
            return $validator->messages();
        }
        
        $habitacion_reserva = Habitacion_Reserva::create($request->all());
        
        return $habitacion_reserva;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\habitacion_reserva  $habitacion_reserva
     * @return \Illuminate\Http\Response
     */
    public function show(habitacion_reserva $habitacion_reserva)
    {
        return $habitacion_reserva;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\habitacion_reserva  $habitacion_reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(habitacion_reserva $habitacion_reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\habitacion_reserva  $habitacion_reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, habitacion_reserva $habitacion_reserva)
    {
        $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        
        $habitacion_reserva->update($request->all());
        
        return $habitacion_reserva;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\habitacion_reserva  $habitacion_reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(habitacion_reserva $habitacion_reserva)
    {
        if($habitacion_reserva->es_valido){
            $habitacion_reserva->es_valido = false;
            $habitacion_reserva->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
