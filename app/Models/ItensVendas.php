<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensVendas extends Model
{
    protected $fillable = ['idMudas', 'idVenda', 'descricao', 'quant', 'precoUn', 'precoTotal'];
}
