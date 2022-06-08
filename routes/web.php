<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    if(!auth()->user())
        return view('welcome');
    else
        return redirect('home');
});

Route::group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('registros-aleatorios', 'HomeController@registrosAleatorios')->name('registrosAleatorios');
    Route::get('mensajes-administrador', 'HomeController@mensajesGuardados')->name('mensajesGuardados');
    Route::get('mensajes-automaticos', 'HomeController@mensajesAutomaticos')->name('mensajesAutomaticos');
    Route::get('tareas_programadas', 'HomeController@tareasProgramadas')->name('tareasProgramadas');
    Route::post('guardar-mensaje', 'HomeController@guardarMensaje')->name('guardarMensaje');


    Route::resource('empleados', 'Empleados');

    Route::group(['prefix'=>'reportes','as'=>'reportes.'], function (){
        Route::get('pdf', 'Empleados@downloadPDF')->name('downloadPDF');
        Route::get('excel', 'Empleados@downloadExcel')->name('dowloadExcel');
    });

});


