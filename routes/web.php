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

Route::resource('gestion/formularios','FormularioController');
Route::resource('gestion/preguntas','PreguntaController');
Route::resource('gestion/ambientes','AmbienteController');
Route::resource('gestion/sedes','SedeController');
Route::resource('gestion/usuarios','UsuarioController');
Route::resource('gestion/fichas','FichaController');