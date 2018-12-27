<?php

namespace App\Http\Controllers;

use App\Pasaje;
use Illuminate\Http\Request;
use Validator;
class PasajeController extends Controller
{
    public function rules(){
        return  [
        'fila'=>'required|alpha',
        'columna'=>'required|numeric|max:100',
        'pasaje_simple'=>'required|boolean',
        'asiento_bussiness'=>'required|boolean',
        'asiento_discapacidad'=>'required|boolean',
        'reserva_id'=>'required|numeric|exists:reservas,id',
        'vuelo_id'=>'required|numeric|exists:vuelos,id'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Pasaje::all(); //
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
        
        $pasaje = new \App\Pasaje;
        $pasaje->fila = $request->get('fila');
        $pasaje->columna = $request->get('columna');
        $pasaje->pasaje_simple = $request->get('pasaje_simple');
        $pasaje->asiento_bussiness= $request->get('asiento_bussiness');
        $pasaje->asiento_discapacidad= $request->get('asiento_discapacidad');
        $pasaje->reserva_id= $request->get('reserva_id');
        $pasaje->vuelo_id= $request->get('vuelo_id');
        $pasaje->save();
        return $pasaje;//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function show(Pasaje $pasaje)
    {
        return $pasaje;//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasaje $pasaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasaje $pasaje)
    {
               $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages(); 
        }
        
        
        $pasaje->fila = $request->get('fila');
        $pasaje->columna = $request->get('columna');
        $pasaje->pasaje_simple = $request->get('pasaje_simple');
        $pasaje->asiento_bussiness= $request->get('asiento_bussiness');
        $pasaje->asiento_discapacidad= $request->get('asiento_discapacidad');
        $pasaje->reserva_id= $request->get('reserva_id');
        $pasaje->vuelo_id= $request->get('vuelo_id');
        $pasaje->save();
        return $pasaje;// //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasaje $pasaje)
    {
        if($pasaje->es_valido){
            $pasaje->es_valido = false;
            $pasaje->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);//
    }
}
