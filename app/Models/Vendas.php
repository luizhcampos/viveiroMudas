<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    
    protected $fillable = ['documento', 'precoTotalVenda', 'data', 'idClientes', 'idUsers'];
    
    public function searchMudas ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('nomePopular', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $results;
    }

    public function search ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('documento', 'LIKE', "%{$filter}%");
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
