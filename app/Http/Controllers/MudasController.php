<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMudas;
use App\Models\Mudas;
use App\Models\Recipientes;
use App\Models\Sementes;
use App\Models\Substratos;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\BinaryOp\BooleanAnd;
use PHPUnit\Framework\Error\Error;
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
        $mudas = $this->repository->where('mudas.quant','>',0)->orderBy('mudas.id', 'DESC')->paginate();

        $Recipientes = Recipientes::all();
        $Substratos = Substratos::all();
        $Sementes = Sementes::all();


        return view ('mudas.index', [
            'mudas' => $mudas,
            'Recipientes' => $Recipientes,
            'Substratos' => $Substratos,
            'Sementes' => $Sementes,
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
        $mudas = new Mudas();

        return view ('mudas.create', [
            'Recipientes' => $Recipientes,
            'Substratos' => $Substratos,
            'Sementes' => $Sementes,
            'mudas'=> $mudas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestMudas $request, Recipientes $recipientes, Sementes $sementes, Substratos $substratos)
    {
        $data = $request->all();


        $recipientes = $recipientes->getSender($request->idRecipientes);
        $sementes = $sementes->getSender($request->idSementes);
        $substratos = $substratos->getSender($request->idSubstratos);

        $mudas = Mudas::create($data);

        if (isset($recipientes))
        {
            $this->atualizaRecipiente($request, $recipientes, $mudas);
        }
        if (isset($sementes))
        {
            $this->atualizaSementes($request, $sementes, $mudas);
        }
        if (isset($substratos) && isset($recipientes) && ($request->volume_Subs_Recip <> NULL))
        {
            $this->atualizaSubstrato($request, $substratos, $mudas);
        }

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
        if (!$mudas = Mudas::find($id))
            return redirect()->back();

        $Recipientes = Recipientes::all();
        $Substratos = Substratos::all();
        $Sementes = Sementes::all();
            
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
    public function update(RequestMudas $request, $id, Recipientes $recipientes, Sementes $sementes, Substratos $substratos)
    { 

        if (!$mudas = Mudas::find($id))
            return redirect()->back();

        $recipientes = $recipientes->getSender($request->idRecipientes);
        $sementes = $sementes->getSender($request->idSementes);
        $substratos = $substratos->getSender($request->idSubstratos);

        if (isset($recipientes))
        {
            $this->atualizaRecipiente($request, $recipientes, $mudas);
        }
        if (isset($sementes))
        {
            $this->atualizaSementes($request, $sementes, $mudas);
        }
        if (isset($substratos) && isset($recipientes) && ($request->volume_Subs_Recip <> NULL))
        {
            $this->atualizaSubstrato($request, $substratos, $mudas);
        }

        $mudas->update($request->all());
        
        return redirect()->route('mudas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletar($id)
    {
        
        if (!$mudas = Mudas::find($id))
            return redirect()->back();

        $mudas->forceDelete();

        return redirect()->route('mudas.index');
    }

    public function search (Request $request, Mudas $mudas)
    {
        
        $mudas = $this->repository->search($request->filter);

        $Recipientes = Recipientes::all();
        $Substratos = Substratos::all();
        $Sementes = Sementes::all();    

        $filters = $request->except('_token');

        return view('mudas.index', [
            'mudas'=> $mudas,
            'Recipientes' => $Recipientes,
            'Substratos' => $Substratos,
            'Sementes' => $Sementes,
            'filters' => $filters,
        ]);
    }


    public function getMudas ($id)
    {
        
        $mudas = Mudas::where('id', '=', $id)->first();
        //dd($mudas);     
        return Response()->json($mudas);

    }

    public function moverMuda (Request $request)
    {       
        if (!$mudas = Mudas::find($request->id))
            return redirect()->back();
        
        $Recipientes = Recipientes::find($request->idRecipientes);
        $Substratos = Substratos::all();
        $Sementes = Sementes::all();
         
        if (Mudas::where('id', $request->id)->update([
            'blocoPlantio'   =>($request->blocoPlantio),
            'taxaPerda'      =>($request->taxaPerda),
            'canteiroPlantio'=>($request->canteiroPlantio),
            'dataAtualizacao'=>($request->dataAtualizacao),
            'estagioMuda'    =>($request->estagioMuda),
            'quant'          =>($request->quant),
            'idRecipientes'  =>($request->idRecipientes),
        ])
        ) {
            
            Recipientes::where('id', $request->idRecipientes)->update(array('quant'=> $Recipientes->quant - $request->quant));
            
            $mudas = $this->repository->paginate();
            return response()->json(array('success' => true));
        }
    }

    public function atualizaRecipiente($request, $recipientes, $mudas)
    {
        if($request->isMethod('POST'))
        {
            Recipientes::where('id', $request->idRecipientes)->update(array('quant'=>($recipientes->quant - $request->quant)));
        } else {
            if ($mudas->quant != $request->quant)
            { 
                Recipientes::where('id', $request->idRecipientes)->update(array(
                    'quant'=>($recipientes->quant + ($mudas->quant - $request->quant))));
            }
        }
    }

    public function atualizaSementes($request, $sementes, $mudas)
    {
    
        //Valor do peso de 100Un. x Quantidade de Sementes / 100
        $transformaPeso = $sementes->peso_100 * $request->quant / 100;
        if($request->isMethod('POST'))
        {
            Sementes::where('id', $request->idSementes)->update(array('quant_total'=>($sementes->quant_total - $transformaPeso)));
        } else {
            if ($mudas->quant != $request->quant)
            { 
                Sementes::where('id', $request->idSementes)->update(array(
                    'quant_total'=>($sementes->quant_total - $transformaPeso)));
            }
        }
    }

    public function atualizaSubstrato ($request, $substratos, $mudas)
    {
        //Quantidade de mudas * Volume por Recipiente (Transformar de dm³ para m³)
        //$transformaVolume = $request->quant * $request->volume_Subs_Recip;
        //$transformaVolumeMuda = $mudas->quant * $mudas->volume_Subs_Recip;
        
        if($request->isMethod('POST'))
        {
            Substratos::where('id', $request->idSubstratos)->update(array('quant'=>($substratos->quant - $request->volume_Subs_Recip)));
        } else {

            if ($mudas->idSubstratos != $request->idSubstratos)
            {
                Substratos::where('id', $request->idSubstratos)->update(array(
                    'quant'=>($substratos->quant - $request->volume_Subs_Recip)));

            }
        }
           
    }

}
