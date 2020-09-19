{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Dados da empresa baseado num Seed!</p>
    
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> {{$empresas[0]->nome}}
                <small class="float-right">Data:
                    <?php $currentDateTime = new DateTime('now');
                    echo $currentDateTime->format('d-m-Y');?> 
                </small>
            </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            <address>
                <strong>Endereço</strong><br>
                {{$empresas[0]->rua}}<br>
                Número: {{$empresas[0]->num}}<br>
                Bairro: {{$empresas[0]->bairro}}<br>
                {{$empresas[0]->cidade}} / {{$empresas[0]->uf}}<br>
                CEP: {{$empresas[0]->cep}}
            </address>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$mudas->count()}}</h3>
  
                  <p>Espécies Plantadas</p>
                </div>
                <div class="icon">
                  <i class="fab fa-canadian-maple-leaf"></i>
                </div>
                <a href="mudas" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$vendas->count()}}<!--<sup style="font-size: 20px">%</sup>--></h3>
                  <p>Vendas Realizadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <a href="vendas" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$empresas[0]->quantProducao}}</h3>
  
                  <p>Capacidade de Produção</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <a href="mudas" class="small-box-footer">Mais Informações<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{$clientes->count()}}</h3>
  
                  <p>Clientes</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-check"></i>
                </div>
                <a href="clientes" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop