@extends('adminlte::page')

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <a class="small-box bg-info text-center" style="padding: 12px 0 10px 0" href="{{route('substratos.create')}}">
                            
                                <h4>Cadastre um novo Substrato
                            <i class="fa fa-feather-alt"></i>
                            </h4>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="small-box text-center" style="padding: 10px">
                        <form action="{{ route('substratos.search') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="filter" class="form-control rounded-0" 
                                    placeholder="Digite o nome do substrato..." value="{{$filters['filter']??null}}">
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
            <h3 class="card-title">Lista de Substratos</h3>

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
                            Identificador
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            Composto(s)
                        </th>
                        <th>
                            Quantidade Litros
                        </th>
                        <th>
                            Data do Cadastro
                        </th>
                        <th>
                            Observação
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($substratos as $key => $value)
                    <tr>
                        <td>
                            {{$value['id']}}
                        </td>
                        <td>
                            <a>
                                {{$value['nome']}}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{$value['composto']}}
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
                                if ($value['inicioMaturacao'] != null) {
                                    echo date_format(new DateTime($value['inicioMaturacao']), "d/m/Y");
                                }
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['observacao']}}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-warning btn-sm" href="{{route('substratos.edit', $value['id'])}}">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                            
                            <a class="btn btn-danger btn-sm" href="{{route('substratos.deletar', $value['id'])}}">
                                <i class="fas fa-trash">
                                </i>
                                Deletar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            
        @if (isset($filters))
            {!! $substratos->appends($filters)->links() !!}
        @else
            {!! $substratos->links() !!}
        @endif
        
        </div>
      <!-- /.card -->
    </section>
@Stop

@section('js')

@stop