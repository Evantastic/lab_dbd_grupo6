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
        'apellido'=>'nullable|string|max:128',
        'nacionalidad'=>'nullable|string|max:32',
        'edad'=>'nullable|numeric|max:100',
        'tipoUsuario'=>'nullable|numeric|max:10',
        'email'=>'required|string|max:32',
        'password'=>'required|string|max:32'


        ];
    }
        public function rulesPut(){
        return[
        'name'=>'nullable|string|max:128',
        'apellido'=>'nullable|string|max:128',
        'nacionalidad'=>'nullable|string|max:32',
        'edad'=>'nullable|numeric|max:100',
        'tipoUsuario'=>'nullable|numeric|max:10',
        'email'=>'nullable|string|max:32',
        'password'=>'nullable|string|max:32'


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

        $user = User::create($request->all());
        $user->tipoUsuario=1;
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

        return view('usuario')->withCompras($user->compras()->get());
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
        $validator = Validator::make($request->all(),$this->rulesPut());
        if($validator->fails()){
            return $validator->messages();
        }
        $user->update($request->all());
        return $user;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = \App\User::findOrFail($id);
        }
        catch(\Exception $e){
            return json_encode(['outcome' => 'error']);
        }
        if($user->es_valido){
            $user->es_valido = false;
            $user->save();
            return json_encode(['outcome' => 'success']);
        }
        return json_encode(['outcome' => 'error']);
    }//


    /**
    * Redirect the user to the provider authentication page.
    *
    * @return \Illuminate\Http\Redirect
    */
    public function redirectToProvider($provider)
    {
        config(['services.' . $provider . '.redirect' => route('provider.callback', [$provider])]);
        return Socialite::driver($provider)->redirect();
    }

    /**
    * Get the user information from provider.
    *
    * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
    }

}
