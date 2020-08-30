<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mudas extends Model
{
    protected $fillable = ['nomePopular', 'nomeCientifico', 'quant', 'dataPlantio', 'custoProducao', 'blocoPlantio', 'tipoPlantio','canteiroPlantio',
    'estagioMuda', 'taxaPerda', 'dataAtualizacao', 'idSubstratos', 'idSementes', 'idRecipientes', 'volume_Subs_Recip', 'observacao'];

    public function Search ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('nomePopular', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $results;
    }

    public function getSender ($sender)
    {
        return $this->where('id', $sender)
            ->get()
            ->first();
    }


}
