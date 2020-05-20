<?php

namespace App\Models;

use Dotenv\Result\Result;
use Illuminate\Database\Eloquent\Model;

class Sementes extends Model
{
    protected $fillable = ['nomePopular', 'nomeCientifico', 'quant_total', 'peso_100', 'observacao', 'localColeta', 'dataColeta'];

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