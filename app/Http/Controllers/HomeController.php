<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Empresas;
use App\Models\Mudas;
use Illuminate\Http\Request;
use  App\Models\Vendas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresas = Empresas::all();
        $mudas = Mudas::all();
        $clientes = Clientes::all();
        $vendas = Vendas::all();
        
        return view('/home', ['empresas' => $empresas, 'vendas' => $vendas, 'mudas'=> $mudas, 'clientes'=> $clientes]);
    }
}
