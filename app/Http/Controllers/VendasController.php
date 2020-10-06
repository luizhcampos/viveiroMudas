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
use ItensVenda;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request, Vendas $vendas, Mudas $mudas)
    {
        $this->request = $request;
        
        $this->repository = $vendas;
        $this->repositoryMudas = $mudas;
    }

    public function index()
    {
        $clientes = Clientes::all();
        $mudas    = Mudas::all();
        $user     = User::all();
        $vendas = $this->repository->orderBy('vendas.id', 'DESC')->paginate();
        return view ('vendas.index',[
            'vendas' => $vendas,
            'clientes'=> $clientes,
            'users'=>$user,
            'mudas'=>$mudas,
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
        $mudas    = Mudas::all()->where('quant','>',0);
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

            $Itensvenda = $request->all();
            
            foreach ($Itensvenda["idItemVenda"] as $item)
            {
                ItensVendas::create([
                    'idMudas' => $item["idMudas"],
                    'idVenda' => $vendas->id,
                    'quant' => $item["quant"],
                    'precoUn' => $item["precoUn"],
                    'precoTotal' => $item["precoTotal"],
                ]);

                $mudas = Mudas::find($item["idMudas"]);
                
                Mudas::where('id', $item["idMudas"])->update(array('quant' => $mudas->quant - $item["quant"]));
            }

            return response()->json(array('success' => true, 'messagem' => 'Venda Cadastrada com Sucesso!'));
        }
        else
            return response()->json(array('error' => true, 'messagem' => 'Erro ao cadastrar a venda!'));
        
    }

    public function search (Request $request, Vendas $vendas)
    {
        
        $vendas = $this->repository->search($request->filter);

        $clientes = Clientes::all();
        $user = User::all();
        $muda = Mudas::all();    

        $filters = $request->except('_token');

        return view('vendas.index', [
            'clientes' => $clientes,
            'vendas' => $vendas,
            'users'  => $user,
            'filters' => $filters,
        ]);
    }
    
    public function getVendas ($id)
    {
        
        $vendas = Vendas::where('id', '=', $id)->first();
        $clientes = Clientes::where('id', '=', $vendas->idClientes)->first();
        $user = User::where('id', '=', $vendas->idUsers)->first();
        $itensVenda = ItensVendas::all()->where('idVenda', '=', $id);
        //dd($mudas);     
        return Response()->json([$vendas, $clientes, $user, $itensVenda]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletar($id)
    {
        
        if (!$vendas = Vendas::find($id))
            return redirect()->back();

        $vendas->forceDelete();

        return redirect()->route('vendas.index');
    }

}
