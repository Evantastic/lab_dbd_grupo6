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

Route::get('/', function () {
    return view('welcome');
});

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
Route::resource('/Log','LogAdministradorController');
Route::resource('/recorrido_reserva','RecorridoReservaController');
Route::resource('/habitacion_reserva','HabitacionReservaController');
Route::resource('/paquete_reserva','PaqueteReservaController');
Route::resource('/reserva_vehiculo','ReservaVehiculoController');
Route::resource('/recorrido_vuelo','RecorridoVueloController');
