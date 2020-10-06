<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>

@extends('adminlte::page')

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <a class="small-box bg-info text-center" style="padding: 12px 0 10px 0" href="{{route('sementes.create')}}">
                            <!--{{ $totalSementes }} <h4>Sementes Cadastradas-->
                                <h4>Cadastre uma nova Semente
                            <i class="fa fa-burn"></i>
                            </h4>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="small-box text-center" style="padding: 10px">
                        <form action="{{ route('sementes.search') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="filter" class="form-control rounded-0" 
                                    placeholder="Digite o nome da Semente..." value="{{$filters['filter']??null}}">
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
            <h3 class="card-title">Lista de Sementes</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
            <div class="card-body p-0 text-center">
            <table class="table table-striped projects text-center">
                <thead>
                    <tr>
                        <th>
                            Lote
                        </th>
                        <th>
                            Nome Popular
                        </th>
                        <th>
                            Peso 100 Un em Kg
                        </th>
                        <th>
                            Peso Total em Kg
                        </th>
                        <th>
                            Data da Coleta
                        </th>
                        <th>
                            Local da Coleta
                        </th>
                        <th>
                            Observação
                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sementes as $key => $value)
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
                                {{$value['peso_100']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['quant_total']}}
                            </a>
                        </td>
                        <td >
                            <a >
                                @php
                                if ($value['dataColeta'] != null) {
                                    echo date_format(new DateTime($value['dataColeta']), "d/m/Y");
                                }
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['localColeta']}}
                            </a>
                        </td>
                        <td >
                            <a>
                                {{$value['observacao']}}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-warning btn-sm" href="{{route('sementes.edit', $value['id'])}}">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                        </td>
                        <td>  
                            <a class="btn btn-danger btn-sm" href="{{route('sementes.deletar', $value['id'])}}">
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

            @if (isset($filters))
                {!! $sementes->appends($filters)->links() !!}
            @else
                {!! $sementes->links() !!}
            @endif
            <!-- /.card-body -->
        </div>
      <!-- /.card -->
    </section>
@Stop



  
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop