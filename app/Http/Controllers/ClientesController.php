<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Http\Requests\RequestClientes;

class ClientesController extends Controller
{

    protected $request;

    public function __construct(Request $request, Clientes $cliente)
    {
        $this->request = $request;
        $this->repository = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes  = $this->repository->paginate();

        return view ('clientes.index', [
            'clientes' => $clientes
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestClientes  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestClientes $request)
    {
        $data = $request->all();

        $clientes = Clientes::create($data);
            
        if ($clientes){
            return redirect()->route('clientes.index');
        } else { 
            return redirect()->route('clientes.create');
        }
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
        if (!$clientes = Clientes::find($id))
            return redirect()->back();
            
        return view ('clientes.edit', compact('clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RequestClientes  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestClientes $request, $id)
    {
        if (!$clientes = Clientes::find($id))
            return redirect()->back();

        $clientes->update($request->all());

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletar($id)
    {
        if (!$clientes = Clientes::find($id))
            return redirect()->back();

        $clientes->delete();

        return redirect()->route('clientes.index');
    }

    public function search (Request $request, Clientes $cliente)
    {
        
        $cliente = $this->repository->search($request->filter);

        $filters = $request->except('_token');

        return view('clientes.index', [
            'clientes'=> $cliente,
            'filters' => $filters,
        ]);
    }
}
