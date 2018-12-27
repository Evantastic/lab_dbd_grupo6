<?php

namespace App\Http\Controllers;

use App\Recorrido_Vuelo;
use Illuminate\Http\Request;
use Validator;
class RecorridoVueloController extends Controller
{

    public function rules(){
        return  [
        'recorrido_id'=> 'required|numeric|exists:recorridos,id',
        'vuelo_id'=> 'required|numeric|exists:vuelos,id'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return \App\Recorrido_Vuelo::all(); //
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
        
        $Recorrido_Vuelo = new \App\Recorrido_Vuelo;
        $Recorrido_Vuelo->recorrido_id = $request->get('recorrido_id');
        $Recorrido_Vuelo->vuelo_id = $request->get('vuelo_id');
        
        $Recorrido_Vuelo->save();
        return $Recorrido_Vuelo;
    }  //
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Recorrido_Vuelo  $recorrido_Vuelo
     * @return \Illuminate\Http\Response
     */
    public function show(Recorrido_Vuelo $recorrido_Vuelo)
    {
       return $recorrido_Vuelo; //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recorrido_Vuelo  $recorrido_Vuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recorrido_Vuelo $recorrido_Vuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recorrido_Vuelo  $recorrido_Vuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recorrido_Vuelo $recorrido_Vuelo)
    {
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages(); 
        }
        
        
        $Recorrido_Vuelo->recorrido_id = $request->get('recorrido_id');
        $Recorrido_Vuelo->vuelo_id = $request->get('vuelo_id');
        
        $Recorrido_Vuelo->save();
        return $Recorrido_Vuelo; //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recorrido_Vuelo  $recorrido_Vuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recorrido_Vuelo $recorrido_Vuelo)
    {
        if($recorrido_Vuelo->es_valido){
            $recorrido_Vuelo->es_valido = false;
            $recorrido_Vuelo->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']); //
    }
}
