<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = ['nome', 'CPF', 'dataNasc', 'sexo', 'rua', 'bairro', 'cidade', 'cep','num', 'uf'];

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