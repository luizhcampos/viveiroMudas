<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mudas extends Model
{
    protected $fillable = ['nomePopular', 'nomeCientifico', 'quant', 'dataColeta', 'precoMuda', 'blocoPlantio', 'tipoPlantio','canteiroPlantio',
    'estagioMuda', 'idSubstratos', 'idSementes', 'idRecipientes', 'observacao'];

    public function Search ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('nomePopular', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $results;
    }
}
