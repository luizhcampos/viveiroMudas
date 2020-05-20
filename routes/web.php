<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home',        'HomeController@index')->name('home');
//Rotas Módulo de Sementes

Route::resource('sementes', 'SementesController');
Route::any('sementes/search', 'SementesController@search')->name('sementes.search');

Route::resource('substratos', 'SubstratosController');
Route::any('substratos/search', 'SubstratosController@search')->name('substratos.search');

Route::resource('recipientes', 'RecipientesController');
Route::any('recipientes/search', 'RecipientesController@search')->name('recipientes.search');

Route::resource('mudas', 'MudasController');
Route::any('mudas/search', 'MudasController@search')->name('mudas.search');
Route::get('muda/{idMuda}', 'MudasController@getMudas');
Route::any('mudas/moverMuda/{id}', 'MudasController@moverMuda')->name('mudas.moverMuda');

Route::any('users/search', 'UsersController@search')->name('users.search');
Route::resource('users', 'UsersController');

Route::any('clientes/search', 'ClientesController@search')->name('clientes.search');
Route::resource('clientes', 'ClientesController');