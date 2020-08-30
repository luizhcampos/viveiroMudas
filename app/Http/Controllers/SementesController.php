<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSementes;
use App\Models\Sementes;
use Illuminate\Http\Request;

class SementesController extends Controller
{
    protected $request;

    public function __construct(Request $request, Sementes $semente)
    {
        $this->request = $request;
        $this->repository = $semente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sementes = Sementes::paginate();
        $totalSementes = $this->repository->where('quant_total', '>', 0)->count();
        return view ('sementes.index', [
            'sementes' => $sementes, 
            'totalSementes' => $totalSementes
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sementes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestSementes  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSementes $request)
    {
        $data = $request->all();

        $sementes = Sementes::create($data);

        if ($sementes){
            return redirect()->route('sementes.index');
        } else { 
            return redirect()->route('sementes.create');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$sementes = Sementes::find($id))
            return redirect()->back();

        return view ('sementes.edit', compact('sementes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RequestSementes  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSementes $request, $id)
    {
        if (!$sementes = Sementes::find($id))
            return redirect()->back();

        if ($sementes->update($request->all()))
        {
            return redirect()
                ->route('sementes.index')
                ->with('success', 'Cadastro Realizado com Sucesso!');
        }
        else
        {
            //return redirect()->route('sementes.edit', compact($id));
            return redirect()
                ->back()
                ->with('error', 'Falha ao Cadastrar!')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletar($id)
    {

        if (!$sementes = Sementes::find($id))
            return redirect()->back();

        $sementes->delete();

        return redirect()->route('sementes.index');
    }

    public function search (Request $request, Sementes $semente)
    {
        
        $sementes = $this->repository->search($request->filter);
        
        $totalSementes = $this->repository->where('quant_total', '>', 0)->count();

        $filters = $request->except('_token');

        return view('sementes.index', [
            'sementes'=> $sementes,
            'filters' => $filters,
            'totalSementes' => $totalSementes,
        ]);
    }

}
