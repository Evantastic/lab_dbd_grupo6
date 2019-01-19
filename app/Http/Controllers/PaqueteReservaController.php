<?php

namespace App\Http\Controllers;

use App\Paquete_Reserva;
use Illuminate\Http\Request;
use Validator;
class PaqueteReservaController extends Controller
{
   
    public function rules(){
        return  [

        'paquete_id' => 'required|numeric|exists:paquetes,id',
        'reserva_id' => 'required|numeric|exists:reservas,id',
        'descuento' => 'required|numeric|max:80'

        ];
    }
        public function rulesPut(){
        return  [

        'paquete_id' => 'nullable|numeric|exists:paquetes,id',
        'reserva_id' => 'nullable|numeric|exists:reservas,id',
        'descuento' => 'nullable|numeric|max:80'

        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Paquete_Reserva::all(); //
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
        
        $paquete_reserva = Paquete_Reserva::create($request->all());

        return $paquete_reserva;//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\paquete_reserva  $paquete_reserva
     * @return \Illuminate\Http\Response
     */
    public function show(paquete_reserva $paquete_reserva)
    {
        return $paquete_reserva;//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\paquete_reserva  $paquete_reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(paquete_reserva $paquete_reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\paquete_reserva  $paquete_reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, paquete_reserva $paquete_reserva)
    {
               $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages(); 
        }
        
 
        $paquete_reserva->update($request->all());
        return $paquete_reserva;// //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\paquete_reserva  $paquete_reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(paquete_reserva $paquete_reserva)
    {
               if($paquete_reserva->es_valido){
            $paquete_reserva->es_valido = false;
            $paquete_reserva->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);//
    } //
    
}
