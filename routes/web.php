	<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'ViajeController@index');
Route::get('/buscar', 'ViajeController@buscarOrigenDestino');
Route::get('/viajes/{viaje}','ViajeController@show')->name('viaje');
Route::get('/comprar/{recorrido}','RecorridoController@comprar');
Route::get('/comprar/{recorrido}/boleta','RecorridoController@boleta');
Route::get('/comprar/{recorrido}/confirmar/{user}/{reserva}','CompraController@confirmar');
Route::get('/comprar/paquete/{paquete}','PaqueteController@compra');
Route::get('/comprar/paquete/{paquete}/boleta','PaqueteController@boleta');
Route::get('/comprar/paquete/{paquete}/{user}/{reserva}/{vehiculo}/{habitacion}/{recorrido}','PaqueteController@confirmar');
Route::get('/check-in','CompraController@checkin');
Route::get('/comprar/vehiculo/{vehiculo}','VehiculoController@compra');
Route::get('/comprar/vehiculo/{vehiculo}/boleta','VehiculoController@boleta');
Route::get('/comprar/vehiculo/{vehiculo}/{user}/{reserva}','VehiculoController@confirmar');
Route::get('/comprar/habitacion/{habitacion}','HabitacionController@compra');
Route::get('/comprar/habitacion/{habitacion}/boleta','HabitacionController@boleta');
Route::get('/comprar/habitacion/{habitacion}/{user}/{reserva}','HabitacionController@confirmar');
Route::get('/habitacion/buscar', 'HabitacionController@busqueda');
Route::get('/vehiculo/buscar', 'VehiculoController@busqueda');
Route::get('/vuelo/buscar', 'VueloController@busqueda');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/aeropuerto','AeropuertoController');
Route::resource('/viaje','ViajeController');
Route::resource('/ciudad','CiudadController');
Route::resource('/hotel','HotelController');
Route::resource('/habitacion','HabitacionController');
Route::resource('/automotora','AutomotoraController');
Route::resource('/vehiculo','VehiculoController');
Route::resource('/paquete','PaqueteController');
Route::resource('/recorrido','RecorridoController');
Route::resource('/vuelo','VueloController');
Route::resource('/pasaje','PasajeController');
Route::resource('/compra','CompraController');
Route::resource('/reserva','ReservaController');
Route::resource('/usuario','UserController');
Route::resource('/queryLog','QueryLogController');
Route::resource('/recorrido_reserva','RecorridoReservaController');
Route::resource('/habitacion_reserva','HabitacionReservaController');
Route::resource('/paquete_reserva','PaqueteReservaController');
Route::resource('/reserva_vehiculo','ReservaVehiculoController');
Route::resource('/recorrido_vuelo','RecorridoVueloController');
Route::resource('/carrito','CartController');
Route::group(['middleware' => ['auth','admin']], function(){
	Route::get('/admin', function(){
		return view('admin');
	});
Route::get('/admin/vuelo','VueloController@create');
Route::get('/admin/recorrido','RecorridoController@create');
Route::get('/admin/viaje','ViajeController@create');

// Redirect the user to the provider authentication page
Route::get('auth/{provider}', [
    'as' => 'provider.login',
    'uses' => 'Auth\LoginController@redirectToProvider'
	]);

// Get the user information from provider
Route::get('auth/{provider}/callback', [
    'as' => 'provider.callback',
    'uses' => 'Auth\LoginController@handleProviderCallback'
	]);
});
