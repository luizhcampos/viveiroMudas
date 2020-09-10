<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    public function searchMudas ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('nomePopular', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $results;
    }
    
    protected $fillable = ['documento', 'precoTotalVenda', 'data', 'idClientes', 'idUsers'];

    public function itens_vendas()
    {
        return $this->hasMany('Vendas\ItensVendas',
                                    'idMudas', 
                                    'idVenda',  
                                    'quant', 
                                    'precoUn', 
                                    'precoTotal');
    }

}
