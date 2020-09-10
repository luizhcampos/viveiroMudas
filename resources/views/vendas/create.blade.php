@extends('adminlte::page')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<form id='vendas' class="form-horizontal">
    
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
                        <select id="idClientes" name="idClientes" class="custom-select" placeholder="Opcional">
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
                        <input id="idUsersNome" name="idUsersNome" value="{{$user->name}}" type="text" class="form-control input-md" disabled>
                        <input id="idUsers" name="idUsers" value="{{$user->id}}" type="text" class="form-control input-md" disabled hidden>
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
        <!--
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
        </div> -->
        <div class="card-body p-0 text-center">
            <table id="tabelaVendas" class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            Lote N°
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            Estoque
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
                <form id="vendas1">
                <tbody>
                    @foreach ($mudas ?? '' as $key => $value)
                    <tr>
                        <td>
                            <input disabled hidden id="id{{$key}}" data-id="{{$key}}">
                            {{$value['id']}}
                        </td>
                        <td>
                            <a>
                                {{$value['nomePopular']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['quant']}}
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
                            <input class="form-control quant" type="number" onchange="calculaValor(this)" 
                            id="quant{{$value['id']}}" min="0" data-id="{{$value['id']}}">
                        </td>
                        <td >
                            <input class="form-control calc" type="number" name="precoUn" onchange="calculaValor(this)"
                            id="precoUn{{$value['id']}}" min="0" step="0.01"  data-id="{{$value['id']}}" >
                        </td>
                        <td>
                            <input id="totalItem{{$value['id']}}" name="totalItem" type="text" class="form-control input-md"
                            disabled onchange="calculaValorTotal()">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </form>
            </table>
        </div> 

        <div class="card-body">
            <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
            <a type="button" href={{route('vendas.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
        </div> 

    </div>
</form>

@Stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

    function calculaValor($this) {

        //Pega um json com todas as Mudas do Banco
        var Mudas = {!! json_encode($mudas, JSON_FORCE_OBJECT) !!};
        var dataId = $this.getAttribute('data-id');
        
        if($('#quant'+dataId).val() < 0)
        {
            $('#quant'+dataId).val(0); 
        }
        if($('#precoUn'+dataId).val() < 0)
        {
            $('#precoUn'+dataId).val(0); 
        }

        for (key in Mudas) {
            if(Mudas[key].id == dataId){
                if(($('#quant'+dataId).val() != '') && ($('#precoUn'+dataId).val() != '')) {
                    var quant = $('#quant'+dataId).val();
                    var preco = $('#precoUn'+dataId).val();
                    var total = parseInt(quant)* parseFloat(preco);
                    
                    $('#totalItem'+dataId).val(total);
                }
            }
        }
    }

    $( "#vendas" ).submit(function( event ) {
        event.preventDefault();
        var id = $(this).attr("id");

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Mudas = {!! json_encode($mudas, JSON_FORCE_OBJECT) !!};

        var idMuda, quantMuda, precoUnMuda, precoItemVenda, precoTotalVenda=0;
        var objItemVenda = {}
        var i = 0;
        for (key in Mudas) {
            quantMuda = $('#quant'+Mudas[key].id).val();
            if (quantMuda > 0)
            {
                idMuda = Mudas[key].id;
                precoUnMuda = $('#precoUn'+Mudas[key].id).val();
                if(precoUnMuda == '') {
                    precoUnMuda = 0;
                }
                precoItemVenda = parseInt(quantMuda)*parseFloat(precoUnMuda);
                precoTotalVenda += parseFloat(precoItemVenda);
                objItemVenda[i] = {
                    $idMuda: idMuda,
                    $quant: quantMuda,
                    $precoUn: precoUnMuda,
                    $precoTotal: precoItemVenda,
                } 
                i++;
            }
        }

        var objCompleto = {
            documento: $('#documento').val(),
            data: dataAtualFormatada(),
            precoTotalVenda: precoTotalVenda,
            idClientes:  $('#idClientes').val(),
            idUsers:  $('#idUsers').val(),
            idItemVenda: objItemVenda,
        }

        if (objItemVenda[0]){
            $.ajax({
                method: 'POST',
                url: 'vendaMuda',
                dataType: 'JSON',
                data: objCompleto,       
                success: function(data) {      
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Venda criada com sucesso!',
                        showConfirmButton: false,
                        timer: 1500,
                        onClose: () => {    
                            
                            }
                    });
                },
                error: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Erro ao inserir a Venda!',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }

            });
        }
    });
    
    function dataAtualFormatada(){
    var data = new Date(),
        dia  = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();
    return anoF+"-"+mesF+"-"+diaF;
    }
</script>
@stop


