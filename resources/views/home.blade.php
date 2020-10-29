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
  
                  <p>Lotes de Mudas</p>
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
              <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{$mudasEsp}}</h3>
  
                  <p>Mudas / Espécie</p>
                </div>
                <div class="icon">
                  <i class="fas fa-leaf"></i>
                </div>
                <a href="clientes" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>R$ {{$vendaValor}} Reais<!--<sup style="font-size: 20px">%</sup>--></h3>
                  <p>em {{$vendaQuant}} Mudas Vendidas nesse ano</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <a href="vendas" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$mudas->sum('quant')}}</h3>
  
                  <p>Mudas no Viveiro</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <a href="mudas" class="small-box-footer">Mais Informações<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
    </div>
    <div id="chartTipoMuda" style="width: 100; height: 500px;">
      
    
      <input id="mudasQuant" type="text" value="{{$mudas->count()}}" disabled hidden>
      <input id="mudasRes" type="text" value="{{$mudasRes}}" disabled hidden>
      <input id="mudasFrut" type="text" value="{{$mudasFrut}}" disabled hidden>
      <input id="mudasArb" type="text" value="{{$mudasArb}}" disabled hidden>
    </div>
@stop

@section('js')

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
  <script src="https://www.google.com/jsapi"> </script>
    
<script type="text/javascript">
    //carregando modulo visualization
    google.load("visualization", "1", {packages:["corechart"]});

    //função de monta e desenha o gráfico
    function drawChart() {
    //variavel com armazenamos os dados, um array de array's
    //no qual a primeira posição são os nomes das colunas


    var data = google.visualization.arrayToDataTable([
          ['Finalidade de Plantio / Lotes', '% do Viveiro'],
          ['Restauração', parseInt($('#mudasRes').val() )],
          ['Arborização', parseInt($('#mudasArb').val() )],
          ['Frutífera',  parseInt($('#mudasFrut').val() )],
        ]);
    //opções para exibição do gráfico
        var options = {
              title: 'Finalidade de Plantio',//titulo do gráfico
              is3D: false // false para 2d e true para 3d o padrão é false
        };
    //cria novo objeto PeiChart que recebe
    //como parâmetro uma div onde o gráfico será desenhado
        var chart = new google.visualization
        .PieChart(document.getElementById('chartTipoMuda'));
    //desenha passando os dados e as opções
        chart.draw(data, options);
      }
    //metodo chamado após o carregamento
    google.setOnLoadCallback(drawChart);
</script>

  
@stop