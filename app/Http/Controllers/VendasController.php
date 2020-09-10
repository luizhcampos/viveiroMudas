<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Mudas;
use App\Models\Vendas;
use App\Models\Empresas;
use App\Models\ItensVendas;
use App\Models\Recipientes;
use App\Models\Sementes;
use App\Models\Substratos;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request, Mudas $mudas)
    {
        $this->request = $request;
        $this->repositoryMudas = $mudas;
    }

    public function index()
    {
        $clientes = Clientes::all();
        $mudas    = Mudas::all();
        $vendas = Vendas::all();

        return view ('vendas.index',[
            'vendas' => $vendas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresas::find(1);
        $clientes = Clientes::all();
        $mudas    = Mudas::all();
        $vendas   = Vendas::all()->last();
        $user     = Auth::user();

        $newVenda = new Vendas;

        return view ('vendas.create', 
            [
                'user' => $user,
                'vendas' => $newVenda,
                'empresas' => $empresas,
                'clientes' => $clientes ,
                'mudas'    => $mudas,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$vendas = Vendas::find($id))
            return redirect()->back();

        $vendas->delete();

        return redirect()->route('vendas.index');
    }

    public function searchMudas (Request $request, Vendas $vendas, Mudas $mudas)
    {        

        $mudas = $this->repositoryMudas->search($request->filter);

        $Recipientes = Recipientes::all();
        $Substratos = Substratos::all();
        $Sementes = Sementes::all();    

        $filters = $request->except('_token');

        return view('vendas.create', [
            'vendas' => $vendas,
            'mudas'=> $mudas,
            'Recipientes' => $Recipientes,
            'Substratos' => $Substratos,
            'Sementes' => $Sementes,
            'filters' => $filters,
            'empresas' => Empresas::find(1),
            'clientes'=> Clientes::all(),
            'user'=> Auth::user(),
        ]);
    }

    public function vendaMuda(Request $request)
    {
        $data = $request->all();
        $vendas = Vendas::create($data);
        
        if ($vendas)
        {
            Vendas::where('id', $vendas->id)->update(array('documento'=>('Viveiro_IF_' .$vendas->id)));
            /*$vendas->attach(ItensVendas::create($data);
             $itemVenda = ItensVendas::create([
                'idMuda' => $request->idMuda,
                'idVenda'=> $vendas->idVenda,
                'quant'  => $request->quant,
                'precoUn'=> $request->precoUn,
                'precoTotal'=>$request->precoTotal,
            ]);
            if ($itemVenda)
            {
                dd($itemVenda);
            }*/
            return response()->json(array('success' => true, 'messagem' => 'Venda Cadastrada com Sucesso!'));
        }
        else
            return response()->json(array('error' => true, 'messagem' => 'Erro ao cadastrar a venda!'));
        
    }

}
