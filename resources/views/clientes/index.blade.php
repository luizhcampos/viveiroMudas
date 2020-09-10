@extends('adminlte::page')

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <a class="small-box bg-info text-center" style="padding: 12px 0 10px 0" href="{{route('clientes.create')}}">
                            
                                <h4>Cadastre um novo Cliente
                            <i class="fa fa-users"></i>
                            </h4>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="small-box text-center" style="padding: 10px">
                        <form action="{{ route('clientes.search') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="filter" class="form-control rounded-0" 
                                    placeholder="Digite o nome do cliente..." value="{{$filters['filter']??null}}">
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
            <h3 class="card-title">Lista de Clientes</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
            <div class="card-body p-0 text-center">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            Número
                        </th>
                        <th style="width: 15%">
                            Nome
                        </th>
                        <th style="width: 2%">
                            Cidade
                        </th>
                        <th style="width: 20%">
                            Estado
                        </th>
                        <th style="width: 15%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $key => $value)
                    <tr>
                        <td>
                            {{$value['id']}}
                        </td>
                        <td>
                            <a>
                                {{$value['nome']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['cidade']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['uf']}}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-warning btn-sm" href="{{route('clientes.edit', $value['id'])}}">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{route('clientes.deletar', $value['id'])}}">
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
@Stop



  
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        
    </script>
@stop