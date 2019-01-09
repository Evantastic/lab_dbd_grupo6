<?php

namespace App\Http\Controllers;

use Validator;
use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function rules(){
        return ['ciudad_id' => 'required|numeric|exists:ciudades,id',
                'nombre' => 'required|string|max:64',
                'direccion' => 'required|string|max:128',
                'estrellas' => 'required|numeric|between:1,5',
                'descripcion' => 'required|string'
        ];
                    
    }
        public function rulesPut(){
        return ['ciudad_id' => 'nullable|numeric|exists:ciudades,id',
                'nombre' => 'nullable|string|max:64',
                'direccion' => 'nullable|string|max:128',
                'estrellas' => 'nullable|numeric|between:1,5',
                'descripcion' => 'nullable|string'
        ];
                    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hotel::all();
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
        
        $hotel = Hotel::create($request->all());
       
        return $hotel;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return $hotel;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $hotel->update($request->all());

        return $hotel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        if($hotel->es_valido){
            $hotel->es_valido = false;
            $hotel->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
