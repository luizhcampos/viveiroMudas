<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipientes extends Model
{
    protected $fillable = ['nome', 'quant', 'observacao'];

    public function Search ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('nome', 'LIKE', "%{$filter}%");
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
