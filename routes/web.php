<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home',        'HomeController@index')->name('home');
//Rotas Módulo de Sementes
Route::resource('sementes', 'SementesController');
