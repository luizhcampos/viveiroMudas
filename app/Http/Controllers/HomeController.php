<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Empresas;
use App\Models\ItensVendas;
use App\Models\Mudas;
use Illuminate\Http\Request;
use  App\Models\Vendas;
use DateTime;
use Illuminate\Support\Facades\DB;

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
        $mudas = Mudas::where('mudas.quant','>',0);
        $vendas = Vendas::all();
        $mudasFrut = Mudas::where('mudas.tipoPlantio','=', 'Frutífera')->count();
        $mudasArb = Mudas::where('mudas.tipoPlantio', '=', 'Arborização')->count();
        $mudasRes = Mudas::where('mudas.tipoPlantio', '=', 'Restauração')->count();

        $mudasEsp = DB::table('mudas')->select('nomePopular')->distinct('nomePopular')->where('mudas.quant','>', 0)->count();

        $ano = date('Y');

        $vendaValor = DB::table('vendas')->whereBetween('data', [$ano. '-01-01', $ano. '-12-31'])->sum('precoTotalVenda');
        $vendaQuant = DB::table('itens_vendas')->whereBetween('created_at', [$ano. '-01-01', $ano. '-12-31'])->sum('quant');

        $clientes = Clientes::all();
        $vendas = Vendas::all();
        $itensVendas = ItensVendas::all();  

        return view('/home', ['empresas' => $empresas,
                              'vendas' => $vendas,
                              'mudas'=> $mudas,
                              'clientes'=> $clientes,
                              'itensVendas' => $itensVendas,
                              'mudasRes' => $mudasRes,
                              'mudasFrut' => $mudasFrut,
                              'mudasArb' => $mudasArb,
                              'mudasEsp' => $mudasEsp,
                              'vendaValor' => $vendaValor,
                              'vendaQuant' => $vendaQuant,
                            ]);
    }
}
