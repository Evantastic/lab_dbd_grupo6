<?php

namespace App\Http\Controllers;

use App\Reserva_Vehiculo;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class ReservaVehiculoController extends Controller
{
    public function rulesPost(){
        return [
            'vehiculo_id' => 'required|numeric|exists:vehiculos,id',
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'precio' =>'required|numeric',
            'fecha_inicio' => 'required|string',
            'fecha_termino' => 'required|string'
        ];
    }

    public function rulesPut(){
        return [
            'vehiculo_id' => 'nullable|numeric|exists:vehiculos,id',
            'reserva_id' => 'nullable|numeric|exists:reservas,id',
            'precio' =>'nullable|numeric',
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
        return Reserva_Vehiculo::all();
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

        $reserva_vehiculo = Reserva_Vehiculo::create($request->all());
        
        return $reserva_vehiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reserva_vehiculo  $reserva_vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(reserva_vehiculo $reserva_vehiculo)
    {
        return $reserva_vehiculo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reserva_vehiculo  $reserva_vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(reserva_vehiculo $reserva_vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reserva_vehiculo  $reserva_vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reserva_vehiculo $reserva_vehiculo)
    {
        $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $reserva_vehiculo->update($request->all());

        return $reserva_vehiculo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reserva_vehiculo  $reserva_vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(reserva_vehiculo $reserva_vehiculo)
    {
        if($reserva_vehiculo->es_valido){
            $reserva_vehiculo->es_valido = false;
            $reserva_vehiculo->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcom' => 'error']);
    }
}
