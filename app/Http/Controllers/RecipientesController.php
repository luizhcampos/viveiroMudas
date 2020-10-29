<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRecipientes;
use App\Models\Mudas;
use App\Models\Recipientes;
use Illuminate\Http\Request;

class RecipientesController extends Controller
{
    protected $request;

    public function __construct(Request $request, Recipientes $recipientes)
    {
        $this->request = $request;
        $this->repository = $recipientes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipientes = $this->repository->paginate();

        $mudas = Mudas::all();

        return view ('recipientes.index', [
            'recipientes' => $recipientes,
            'mudas'       => $mudas,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('recipientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRecipientes $request)
    {
        $data = $request->all();

        $recipientes = Recipientes::create($data);

        return redirect()->route('recipientes.index');
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
        if (!$recipientes = Recipientes::find($id))
            return redirect()->back();
            
        return view ('recipientes.edit', compact('recipientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestRecipientes $request, $id)
    {
        if (!$recipientes = Recipientes::find($id))
            return redirect()->back();

        $recipientes->update($request->all());

        return redirect()->route('recipientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletar($id)
    {

        if (!$recipientes = Recipientes::find($id))
            return redirect()->back();

        $recipientes->delete();

        return redirect()->route('recipientes.index');
    }

    public function search (Request $request, Recipientes $recipientes)
    {
        
        $recipientes = $this->repository->search($request->filter);

        $filters = $request->except('_token');

        return view('recipientes.index', [
            'recipientes'=> $recipientes,
            'filters' => $filters,
        ]);
    }
}
