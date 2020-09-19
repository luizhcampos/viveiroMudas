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
Route::any('sementes', 'SementesController@search')->name('sementes.search');
Route::any('sementes/deletar/{idSemente}', 'SementesController@deletar')->name('sementes.deletar');

Route::resource('substratos', 'SubstratosController');
Route::any('substratos', 'SubstratosController@search')->name('substratos.search');
Route::POST('substratos/deletar/{idSubstrato}', 'SubstratosController@deletar');

Route::resource('recipientes', 'RecipientesController');
Route::any('recipientes', 'RecipientesController@search')->name('recipientes.search');
Route::any('recipientes/deletar/{idRecipiente}', 'RecipientesController@deletar')->name('recipientes.deletar');

Route::resource('mudas', 'MudasController');
Route::any('mudas', 'MudasController@search')->name('mudas.search');
Route::get('buscar/{idMuda}', 'MudasController@getMudas');
Route::post('muda/moverMuda', 'MudasController@moverMuda')->name('muda.moverMuda');
Route::any('mudas/deletar/{idMuda}', 'MudasController@deletar')->name('mudas.deletar');

Route::any('users', 'UsersController@search')->name('users.search');
Route::resource('users', 'UsersController');
Route::any('users/deletar/{idUsers}', 'UsersController@deletar')->name('users.deletar');

Route::resource('clientes', 'ClientesController');
Route::any('clientes', 'ClientesController@search')->name('clientes.search');
Route::any('clientes/deletar/{idCliente}', 'ClientesController@deletar')->name('clientes.deletar');

Route::resource('vendas', 'VendasController');

Route::post('vendas/vendaMuda', 'VendasController@vendaMuda')->name('vendas.vendaMuda');
Route::any('vendas', 'VendasController@search')->name('vendas.search');
Route::get('buscarVenda/{idVenda}', 'VendasController@getVendas');
Route::any('vendas/searchMudas', 'VendasController@searchMudas')->name('vendas.searchMudas');
Route::any('vendas/deletar/{idVenda}', 'VendasController@deletar')->name('vendas.deletar');