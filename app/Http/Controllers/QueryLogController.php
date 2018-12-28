<?php

namespace App\Http\Controllers;

use App\queryLog;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class QueryLogController extends Controller
{
    public function rules(){
        return [
            'query' => 'required|string',
            'user_id' => 'required|numeric|exists:users,id',
            'fecha_consulta' => 'required|string'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return queryLog::all();
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
        $queryLog = new \App\queryLog;
        $queryLog->query = $request->get('query');
        $queryLog->user_id = $request->get('user_id');
        try{
            $tiempo = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_consulta'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $queryLog->fecha_consulta = $tiempo;
        $queryLog->save();
        return $queryLog;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\queryLog  $queryLog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $queryLog = queryLog::findOrFail($id);
            return $queryLog;
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\queryLog  $queryLog
     * @return \Illuminate\Http\Response
     */
    public function edit(queryLog $queryLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\queryLog  $queryLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $queryLog = queryLog::findOrFail($id);
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $queryLog = new \App\queryLog;
        $queryLog->query = $request->get('query');
        $queryLog->user_id = $request->get('user_id');
        try{
            $tiempo = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('fecha_consulta'));
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $queryLog->fecha_consulta = $tiempo;
        $queryLog->save();
        return $queryLog;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\queryLog  $queryLog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $queryLog = queryLog::findOrFail($id);
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        if($queryLog->es_valido){
            $queryLog->es_valido = false;
            $queryLog->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }
}
