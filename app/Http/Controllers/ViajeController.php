<?php

namespace App\Http\Controllers;

use Validator;
use App\Viaje;
use Illuminate\Http\Request;
use DB;

class ViajeController extends Controller
{
    public function rules(){
        return [
            'ciudad_origen_id' => 'required|numeric|exists:ciudades,id',
            'ciudad_destino_id' => 'required|numeric|exists:ciudades,id|different:ciudad_origen_id',
        ];
    }
    public function rulesPut(){
        return [
            'ciudad_origen_id' => 'nullable|numeric|exists:ciudades,id',
            'ciudad_destino_id' => 'nullable|numeric|exists:ciudades,id|different:ciudad_origen_id',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viajes = Viaje::with('ciudad_origen','ciudad_destino')->get();
        return view('welcome')->withViajes($viajes);
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
        $viaje = Viaje::create($request->all());
        return $viaje;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
      return view('viaje')
      ->withRecorridos($viaje->recorridos()->get())
      ->withViaje($viaje);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Viaje $viaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viaje $viaje)
    {
        $validator = Validator::make($request->all(), $this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $viaje->update($request->all());
        return $viaje;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viaje $viaje)
    {
        if($viaje->es_valido){
            $viaje->es_valido = false;
            $viaje->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }

    public function buscarOrigenDestino(Request $request){
        $origen = $request->origen;
        $destino = $request->destino;
        if($origen != "" && $destino != "" ){
            $ciudad1 = DB::table('ciudades')->where('nombre',$origen)->first();
            $ciudad2 = DB::table('ciudades')->where('nombre',$destino)->first();
            $resultado = DB::table('viajes')->where('ciudad_origen_id',$ciudad1->id)->where('ciudad_destino_id',$ciudad2->id)->first();
            return redirect()->route('viaje',[$resultado->id]);
        }
        else{
            return view('buscar')->withOrigen("")->withDestino("");
        }
    }
}
