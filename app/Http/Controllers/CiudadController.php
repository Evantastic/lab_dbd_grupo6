<?php

namespace App\Http\Controllers;

use Validator;
use App\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function rules(){
        return [
            'nombre' => 'required|string',
            'nombre_pais' => 'required|string'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ciudad::all();
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
        $validator = Validator::make($request->all(),
                                     $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $ciudad = new \App\Ciudad;
        $ciudad->nombre = $request->get('nombre');
        $ciudad->nombre_pais = $request->get('nombre_pais');
        $ciudad->save();
        return $ciudad;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function show(Ciudad $ciudad)
    {
        return $ciudad;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciudad $ciudad)
    {
        $validator = Validator::make($request->all(),
                                     $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $ciudad->nombre = $request->get('nombre');
        $ciudad->nombre_pais = $request->get('nombre_pais');
        $ciudad->save();
        return $ciudad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudad $ciudad)
    {
        if($ciudad->es_valido){
            $ciudad->es_valido = false;
            $ciudad->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
