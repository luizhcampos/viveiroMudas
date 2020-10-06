@extends('adminlte::page')

@section('js')
<script>
    $(document).on('click', '.view_data', function () {
    event.preventDefault();
    var id = $(this).attr("id");
    if (id != 'detalhesVenda'){
        $.ajax({
            url: 'buscarVenda/'+id,
            type: 'GET',
            dataType:'JSON',
            success: function (data) {
                console.log(data);
                $('#id').val(data[0].id);
                $('#idcliente').val(data[1].nome);
                $('#idUsers').val(data[2].name);
                $('#documento').val(data[0].documento);
                $('#valorVenda').val(data[0].precoTotalVenda);
                $('#detalhesVenda').modal('show');
            }
        });
    }
});
</script>

@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <a class="small-box bg-info text-center" style="padding: 12px 0 10px 0" href="{{route('vendas.create')}}">
                                <h4>Cadastre uma nova Venda
                            <i class="fas fa-search-dollar"></i>
                            </h4>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="small-box text-center" style="padding: 10px">
                        <form action="{{ route('vendas.search') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="filter" class="form-control rounded-0" 
                                    placeholder="Digite o documento da venda..." value="{{$filters['filter']??null}}">
                                <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat">Pesquisar!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Vendas </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
            <div class="card-body p-0 text-center">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            N° da Venda
                        </th>
                        <th>
                            Documento
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Funcionário
                        </th>
                        <th>
                            Data da Venda
                        </th>
                        <th>
                            Total da Venda
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendas as $key => $value)
                    <tr>
                        <td>
                            {{$value['id']}}
                        </td>
                        <td>
                            <a>
                                {{$value['documento']}}
                            </a>
                        </td>
                        <td>
                            @foreach ($clientes as $item)
                                @if ($item->id == $value['idClientes'])
                                    {{$item['nome']}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($users as $item)
                                @if ($item->id == $value['idUsers'])
                                    {{$item['name']}}
                                @endif
                            @endforeach
                        </td>
                        <td >
                            <a>
                                @php
                                if ($value['data'] != null) {
                                    echo date_format(new DateTime($value['data']), "d/m/Y");
                                }
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                {{ 'R$ ' .$value['precoTotalVenda']}}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button id="{{$value['id']}}" type="button" class="btn btn-info btn-sm view_data">
                                <i class="fas fa-pencil-alt"></i>
                                Detalhes
                            </button>
                            <a class="btn btn-danger btn-sm" href="{{route('vendas.deletar', $value['id'])}}">
                                <i class="fas fa-trash">
                                </i>
                                Deletar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                @if (isset($filters))
                    {!! $vendas->appends($filters)->links() !!}
                @else
                    {!! $vendas->links() !!}
                @endif
            </div>
    

        </div>
    </section>

    <div class="modal fade" id="detalhesVenda" tabindex="-1" role="dialog" aria-labelledby="modalVenda" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" >Detalhes da Venda
                    <input class="form-control-plaintext" id="id" value="id" disabled>
                </h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="detalhesVenda">
                        @csrf
                        <div class="form-group">
                            <div class="row">  
                                <div class="col-md-12">
                                    <label>Cliente</label>
                                    <input id="idcliente" value="{{$vendas->idCliente ?? '' }}" type="text" class="form-control input-md" disabled>
                                    <label>Documento da Venda</label>
                                    <input id="documento" value="{{$vendas->documento ?? 'New Venda' }}" type="text" class="form-control input-md" disabled>
                                    <label>Funcionário da Venda</label> 
                                    <input id="idUsers" value="{{$vendas->idUsers ?? ''}}"  type="text" class="form-control input-md" disabled>
                                    <label>Total a ser Pago</label>
                                    <input id="valorVenda" value="{{$vendas->valorVenda ?? ''}}" type="number" step="0.01" class="form-control input-md" disabled>
                                    
                                </div>
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
@stop
