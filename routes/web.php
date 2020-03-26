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