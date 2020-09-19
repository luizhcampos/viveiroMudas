<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSubstratos;
use App\Models\Substratos;
use Illuminate\Http\Request;

class SubstratosController extends Controller
{

    protected $request;

    public function __construct(Request $request, Substratos $substrato)
    {
        $this->request = $request;
        $this->repository = $substrato;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $substrato = $this->repository->paginate();

        return view ('substratos.index', [
            'substratos' => $substrato
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('substratos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestSubstratos  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSubstratos $request)
    {
        $data = $request->all();

        $substratos = Substratos::create($data);

        return redirect()->route('substratos.index');
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
        if (!$substratos = Substratos::find($id))
            return redirect()->back();
            
        return view ('substratos.edit', compact('substratos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RequestSubstratos  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSubstratos $request, $id)
    {
        if (!$substratos = Substratos::find($id))
            return redirect()->back();

        $substratos->update($request->all());

        return redirect()->route('substratos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletar($id)
    {

    if (!$substratos = Substratos::find($id))
        return redirect()->back();
        
    $delete = $substratos->delete();


    if ($delete)
        return redirect()
                    ->route('substratos.index')
                    ->with('success', 'Substrato deletado com sucesso!');
 
    // Redireciona de volta com uma mensagem de erro
    return redirect()
                ->back()
                ->with('error', 'Falha ao deletar Substratos!');
    }

    public function search (Request $request, Substratos $substrato)
    {        
        $substrato = $this->repository->search($request->filter);

        $filters = $request->except('_token');

        return view('substratos.index', [
            'substratos'=> $substrato,
            'filters' => $filters,
        ]);
    }

}
