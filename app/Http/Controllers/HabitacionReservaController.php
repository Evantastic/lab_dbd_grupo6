<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion_Reserva;
use Illuminate\Http\Request;

class HabitacionReservaController extends Controller
{
    public function rules(){
        return [
            'habitacion_id' => 'required|numeric|exists:habitaciones,id',
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'precio' => 'required|numeric',
            'fecha_inicio' => 'required|date_format:Y/m/d H:i',
            'fecha_termino' => 'required|date_format:Y/m/d H:i|different:fecha_inicio'
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
        /*$validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $habitacion_reserva = new \App\Habitacion_Reserva;
        $habitacion_reserva->habitacion_id = $request->get('habitacion_id');
        $habitacion_reserva->reserva_id = $request->get('reserva_id');
        $habitacion_reserva->precio = $request->get('precio');
        $habitacion_reserva->fecha_inicio = $request->get('fecha_inicio');
        $habitacion_reserva->fecha_termino = $request->get('fecha_termino');
        $habitacion_reserva->save();
        return $habitacion_reserva;*/
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\habitacion_reserva  $habitacion_reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(habitacion_reserva $habitacion_reserva)
    {
        //
    }
}
