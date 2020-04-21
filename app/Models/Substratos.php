<?php

namespace App\Models;

use Dotenv\Result\Result;
use Illuminate\Database\Eloquent\Model;

class Substratos extends Model
{
    protected $fillable = ['nome', 'composto', 'quant', 'observacao', 'inicioMaturacao'];

    public function Search ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('nome', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $results;
    }
}
