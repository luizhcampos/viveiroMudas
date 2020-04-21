<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMudas;
use App\Models\Mudas;
use App\Models\Recipientes;
use App\Models\Sementes;
use App\Models\Substratos;
use Illuminate\Http\Request;
use stdClass;

class MudasController extends Controller
{
    protected $request;
    

    //Definindo os outros models que serão usados no Formulário
    public $Recipientes;
    public $Substratos;
    public $Sementes;


    public function __construct(Request $request, Mudas $mudas)
    {
        $this->request = $request;
        $this->repository = $mudas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mudas = $this->repository->paginate();

        return view ('mudas.index', [
            'mudas' => $mudas
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Recipientes = Recipientes::all();
        $Substratos = Substratos::all();
        $Sementes = Sementes::all();


        return view ('mudas.create', [
            'Recipientes' => $Recipientes,
            'Substratos' => $Substratos,
            'Sementes' => $Sementes,
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
        $data = $request->all();

        $mudas = Mudas::create($data);

        return redirect()->route('mudas.index');
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
        $Recipientes = Recipientes::all();

        $Substratos = Substratos::all();
        $Sementes = Sementes::all();

        if (!$mudas = Mudas::find($id))
            return redirect()->back();
            
        return view ('mudas.edit', compact('mudas'), [
            'Recipientes' => $Recipientes,
            'Substratos' => $Substratos,
            'Sementes' => $Sementes,
        ]);
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
        if (!$mudas = Mudas::find($id))
            return redirect()->back();

            /*
        $stStatus = new stdClass;

        if ($mudas->update($request->all())) {
            $stStatus = true;
            $stStatus->message = 'A muda foi atualizada com sucesso!'; 
            return redirect()
                ->route('mudas.index')
                ->back()
                ->with('stStatus', $stStatus);
        } else {
            $stStatus = false;
            $stStatus->message = 'A muda não foi atualizada com sucesso!'; 
            return redirect()
                ->route('mudas.index')
                ->back()
                ->with('stStatus', $stStatus);
        } */

        $mudas->update($request->all());

        return redirect()->route('mudas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search (Request $request, Mudas $mudas)
    {
        
        $mudas = $this->repository->search($request->filter);

        $filters = $request->except('_token');

        return view('mudas.index', [
            'mudas'=> $mudas,
            'filters' => $filters,
        ]);
    }
}
