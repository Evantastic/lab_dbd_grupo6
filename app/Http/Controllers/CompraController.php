<?php

namespace App\Http\Controllers;

use App\Compra;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function rules(){
        return [
            'reserva_id' => 'required|numeric|exists:reservas,id',
            'user_id' => 'required|numeric|exists:users,id',
            'fecha_compra' => 'required|string'
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
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $compra = new \App\Compra;
        $compra->reserva_id = $request->get('reserva_id');
        $compra->user_id = $request->get('user_id');
        try{
            $tiempo = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_compra'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $compra->fecha_compra = $tiempo;
        $compra->save();
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
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $compra = new \App\Compra;
        $compra->reserva_id = $request->get('reserva_id');
        $compra->user_id = $request->get('user_id');
        try{
            $tiempo = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_compra'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $compra->fecha_compra = $tiempo;
        $compra->save();
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
