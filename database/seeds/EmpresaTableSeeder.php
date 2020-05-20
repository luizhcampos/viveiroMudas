<?php

use App\Models\Empresas;
use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresas::Create([
            'nome'      =>'Viveiro de Mudas do Instituto Federal de Minas Gerais - Campus São João Evangelista',
            'CNPJ'      =>'10626896/0006-87',
            'quantProducao'=> ('15000'),
            'rua'       => 'Avenida Primeiro de Junho',
            'bairro'    => 'Centro', 
            'cidade'    => 'São João Evangelista',
            'cep'       => '39705-000',
            'num'       => '1043',
            'uf'        => 'MG', 
            'observacao'=> '',
        ]);
    }
}
