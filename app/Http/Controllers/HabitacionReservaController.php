<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion_Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HabitacionReservaController extends Controller
{
    public function rules(){
        return [
            'habitacion_id' => 'required|numeric|exists:habitaciones,id',
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'precio' => 'required|numeric',
            'fecha_inicio' => 'required|string',
            'fecha_termino' => 'required|string'
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
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $habitacion_reserva = new \App\Habitacion_Reserva;
        $habitacion_reserva->habitacion_id = $request->get('habitacion_id');
        $habitacion_reserva->reserva_id = $request->get('reserva_id');
        $habitacion_reserva->precio = $request->get('precio');
        try{
            $tiempo1 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_inicio'));
            $tiempo2 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_termino'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $habitacion_reserva->fecha_inicio = $tiempo1;
        $habitacion_reserva->fecha_termino = $tiempo2;
        $habitacion_reserva->save();
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
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $habitacion_reserva->habitacion_id = $request->get('habitacion_id');
        $habitacion_reserva->reserva_id = $request->get('reserva_id');
        $habitacion_reserva->precio = $request->get('precio');
        try{
            $tiempo1 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_inicio'));
            $tiempo2 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_termino'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $habitacion_reserva->fecha_inicio = $tiempo1;
        $habitacion_reserva->fecha_termino = $tiempo2;
        $habitacion_reserva->save();
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
