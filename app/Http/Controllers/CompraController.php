<?php

namespace App\Http\Controllers;

use App\Compra;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function rulesPost(){
        return [
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'user_id' => 'required|numeric|exists:users,id',
            'fecha_compra' => 'required|string',
            'medio_pago' =>'required|integer|between:0,3'
        ];
    }

    public function rulesPut(){
        return [
            'reserva_id' => 'nullable|numeric|exists:reservas,id',
            'user_id' => 'nullable|numeric|exists:users,id',
            'fecha_compra' => 'nullable|string',
            'medio_pago' =>'nullable|integer|between:0,3'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Compra::all();
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
        $validator = Validator::make($request->all(), $this->rulesPost());
        if($validator->fails()){
            return $validator->messages();
        }

        $compra = Compra::create($request->all());
        
        return $compra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        return $compra;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }

        $compra->update($request->all());
        
        return $compra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        if($compra->es_valido){
            $compra->es_valido = false;
            $compra->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
