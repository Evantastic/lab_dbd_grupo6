<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;
use Validator;
class ReservaController extends Controller
{
    public function rules(){
        return  [

        'costo'=>'required|numeric',
        'seguro'=>'required|boolean',

        ];
    }
    public function rulesPut(){
        return  [

        'costo'=>'nullable|numeric',
        'seguro'=>'nullable|boolean',

        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reserva::all();//
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

        $reserva = Reserva::create($request->all());
        return $reserva;//  //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
       return $reserva; //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
                   $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }


        $reserva->update($request->all());
        return $reserva;   //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
                if($reserva->es_valido){
            $reserva->es_valido = false;
            $reserva->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);//
    }//

}
