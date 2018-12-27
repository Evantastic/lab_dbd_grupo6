<?php

namespace App\Http\Controllers;

use App\Reserva_Vehiculo;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class ReservaVehiculoController extends Controller
{
    public function rules(){
        return [
            'vehiculo_id' => 'required|numeric|exists:vehiculos,id',
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'precio' =>'required|numeric',
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
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $reserva_vehiculo = new \App\Reserva_Vehiculo;
        $reserva_vehiculo->vehiculo_id = $request->get('vehiculo_id');
        $reserva_vehiculo->reserva_id = $request->get('reserva_id');
        $reserva_vehiculo->precio = $request->get('precio');
        try{
            $tiempo1 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_inicio'));
            $tiempo2 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_termino'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        };
        $reserva_vehiculo->fecha_inicio = $tiempo1;
        $reserva_vehiculo->fecha_termino = $tiempo2;
        $reserva_vehiculo->save();
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
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $reserva_vehiculo->vehiculo_id = $request->get('vehiculo_id');
        $reserva_vehiculo->reserva_id = $request->get('reserva_id');
        $reserva_vehiculo->precio = $request->get('precio');
        try{
            $tiempo1 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_inicio'));
            $tiempo2 = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_termino'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $reserva_vehiculo->fecha_inicio = $tiempo1;
        $reserva_vehiculo->fecha_termino = $tiempo2;
        $reserva_vehiculo->save();
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
