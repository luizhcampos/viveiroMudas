<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = ['nome', 'CNPJ', 'quantProducao', 'rua', 'bairro', 'cidade', 'cep','num',
    'uf', 'observacao'];
}
