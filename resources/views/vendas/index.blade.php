@extends('adminlte::page')

@section('js')

@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-12">
                    <a class="small-box bg-info text-center" style="padding: 12px 0 10px 0" href="{{route('vendas.create')}}">
                                <h4>Cadastre uma nova Venda
                            <i class="fas fa-search-dollar"></i>
                            </h4>
                    </a>
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
                            {{$value['idClientes']}}
                        </td>
                        <td>
                            {{$value['idUsers']}}
                        </td>
                        <td >
                            <a>
                                @php
                                echo date_format(new DateTime($value['dataVenda']), "d/m/Y");
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                {{ 'R$ ' .$value['totalVenda']}}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                                Detalhes
                            </a>
                            <a class="btn btn-danger btn-sm" >
                                <i class="fas fa-trash">
                                </i>
                                Deletar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        
                
        </div>
      <!-- /.card -->
    </section>
@stop
