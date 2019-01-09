<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
class UserController extends Controller
{
    public function rules(){
        return[
        'name'=>'required|string|max:128',
        'apellido'=>'required|string|max:128',
        'nacionalidad'=>'required|string|max:32',
        'edad'=>'required|numeric|max:100',
        'tipoUsuario'=>'required|numeric|max:10',
        'email'=>'required|string|max:32',
        'password'=>'required|string|max:32'


        ];
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\User::all();
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
        
        $user = new \App\User;
        $user->name = $request->get('name');
        $user->apellido = $request->get('apellido');
        $user->nacionalidad = $request->get('nacionalidad');
        $user->edad= $request->get('edad');
        $user->tipoUsuario= $request->get('tipoUsuario');
        $user->email= $request->get('email');
        $user->password= $request->get('password');
        $user->save();
        return $user;
    }
 //
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = \App\User::findOrFail($id);
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $user = \App\User::findOrFail($id);
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        $validator = Validator::make($request->all(),$this->rules());
        if($validator->fails()){
            return $validator->messages(); 
        }
        
        
        $user->name = $request->get('name');
        $user->apellido = $request->get('apellido');
        $user->nacionalidad = $request->get('nacionalidad');
        $user->edad=$request->get('edad');
        $user->tipoUsuario= $request->get('tipoUsuario');
        $user->email= $request->get('email');
        $user->password= $request->get('password');
        $user->save();
        return $user;//Aca va lo normal
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
                if($id->es_valido){
            $id->es_valido = false;
            $id->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }//
    
}
