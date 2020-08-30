@extends('adminlte::page')

@section('content')

<div class="form-horizontal">
    <div class="card col-md-12">
        <div class="card-title">
                <i class="fas fa-globe"></i> {{$empresas->nome}}
                <small class="float-right">Data:
                    <?php $currentDateTime = new DateTime('now');
                    echo $currentDateTime->format('d-m-Y');?> 
                </small>
        </div>
        <div class="card-header">
            <div class="form-group">
                <div class="row">  
                    <div class="col-md-3">
                        <label>Cliente</label>
                        <select name="idClientes" class="custom-select" placeholder="Opcional">
                            <option value=""></option>   
                            @foreach ($clientes as $c)
                            <option @if($c->id ?? '' == $c->id) selected  @endif
                                value="{{ $c->id }}">{{ $c->nome }}</option>
                            @endforeach    
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Documento da Venda</label>
                        <input id="documento" name="total" value="{{$vendas->documento ?? 'New Venda' }}" type="text" class="form-control input-md" disabled>
                    </div>
                    <div class="col-md-3">
                        <label>Funcionário da Venda</label>
                        <input id="func" name="func" value="{{$user->name }}" type="text" class="form-control input-md" disabled>
                    </div>
                    <div class="col-md-3">
                        <label>Total a ser Pago</label>
                        <input id="valorVenda" name="valorVenda" value="0" type="number" step="0.01" class="form-control input-md" disabled>
                    </div>
                </div>
            </div>   
        </div>

    </div>
    <div class="card col-md-12">
        <div class="card-header">
            <h3 class="card-title">Lista de Mudas </h3>
            <br>
            <div class="small-box text-center" style="padding: 10px">
                <form action="{{ route('vendas.searchMudas') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="filter" class="form-control rounded-0" 
                            placeholder="Digite o nome da muda..." value="{{$filters['filter']??null}}">
                        <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat">Pesquisar!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0 text-center">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            Lote N°
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            Quantidade
                        </th>
                        <th>
                            Data de Plantio
                        </th>
                        <th>
                            Preço da Mudas
                        </th>
                        <th>
                            Local da Muda
                        </th>
                        <th>
                            Estágio de Produção
                        </th>
                        <th >
                            Quant.
                        </th>
                        <th>
                            Preço Un.
                        </th>
                        <th>
                            Preço Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mudas ?? '' as $key => $value)
                    <tr>
                        <td>
                            {{$value['id']}}
                        </td>
                        <td>
                            <a>
                                {{$value['nomePopular']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['quantMudas']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                @php
                                echo date_format(new DateTime($value['dataPlantio']), "d/m/Y");
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                {{ 'R$ ' .$value['precoMuda']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['blocoPlantio']}}
                            </a>
                            <a>
                                {{$value['canteiroPlantio']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['estagioMuda']}}
                            </a>
                        </td>
                        <td >
                            <input class="form-control calc" type="number" name="quant" id="quant" data-id="{{$value['id']}}">
                        </td>
                        <td >
                            <input class="form-control calc" value="0" type="number" name="precoUn" id="precoUn" data-id="{{$value['id']}}" step="0.01" onfocus="this.value=''" >
                        </td>
                        <td>
                            <input id="totalItem" name="totalItem" type="text" class="form-control input-md" data-id="{{$value['id']}}" disabled>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 

        <div class="card-body">
            <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
            <a type="button" href={{route('vendas.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
        </div> 

    </div>
</div>

@Stop

@section('js')
<script>
    
    document.getElementById("quant").onchange = function() {
        calculaValor()
        };
    document.getElementById("precoUn").onchange = function() {
        calculaValor()
        };

    function calculaValor() {
        var quant = $('#quant').val();
        var preco = $('#precoUn').val();
        var total = parseInt(quant)* parseInt(preco);
        $('#totalItem').val(total);
        calculaValorTotal();
    }

    function calculaValorTotal(){
        var totalVenda = 5000;
        $('#valorVenda').val(totalVenda);
       // data.forEach('#valorVenda' => {
       //     totalVenda += '#totalItem'
       // });
    } 

</script>
@stop


