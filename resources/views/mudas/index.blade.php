@extends('adminlte::page')

@section('js')
    <script>
        $(document).on('click', '.view_data', function () {
            var id = $(this).attr("id");
            if (id != '') {
                $.ajax({
                    url: 'muda/'+id,
                    type: 'GET',
                    dataType:'JSON',
                    success: function (data) {
                        $('#id').val(data.id);
                        $('#blocoPlantio').val(data.blocoPlantio);
                        $('#canteiroPlantio').val(data.canteiroPlantio);
                        $('#estagioMuda').val(data.estagioMuda);
                        $('#idRecipientes').val(data.idRecipientes);
                        $('#moverMudas').modal('show');
                    }
                });
            }
        });
    </script>
    <script>
        $(document).on('click', '#moverMuda', function moverMuda(){
            $.ajax({
                datatype: 'json',
                contentType: "application/json; charset=utf-8",
                type: "POST",
                data: JSON.stringify(resultado), // passe simplesmente o JSON serializado em string
                success: function (data) {
                    alert('Login realizado com sucesso!!');
                }
            });
        });
    </script>
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <a class="small-box bg-info text-center" style="padding: 12px 0 10px 0" href="{{route('mudas.create')}}">
                                <h4>Cadastre uma nova Muda
                            <i class="fa fa-seedling"></i>
                            </h4>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="small-box text-center" style="padding: 10px">
                        <form action="{{ route('mudas.search') }}" method="post">
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
            </div>
        </div>
        
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Mudas </h3>

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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mudas as $key => $value)
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
                        <td class="project-actions text-right">
                            <button id="{{$value['id']}}" type="button" class="btn btn-info btn-sm view_data">
                                <i class="fas fa-truck-moving"></i>
                                Movimentar
                            </button>
                            <a class="btn btn-warning btn-sm" href="{{route('mudas.edit', $value['id'])}}">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{route('mudas.destroy', $value['id'])}}">
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

    <div class="modal fade" id="moverMudas" tabindex="-1" role="dialog" aria-labelledby="modalMudas" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" >Movimentando a Muda 
                    <!--<input class="form-control-plaintext" id="id" value="id">-->
                </h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="moverMudas">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Estágio:</label>
                                <select id='estagioMuda' class="custom-select" type="text" name="estagioMuda" placeholder="Obrigatório" 
                                required='ON' value="">
                                    @if ($mudas->estagioMuda ?? '' != '')
                                        <option value="{{$mudas->estagioMuda}}">{{$mudas->estagioMuda}}</option> 
                                            
                                            @if ($mudas->estagioMuda == 'Berçário')
                                                <option>Rustificação</option>
                                                <option>Alto Padrão</option>
                                            @endif
                                            
                                            @if ($mudas->estagioMuda == 'Rustificação') 
                                                <option>Berçário</option>
                                                <option>Alto Padrão</option>
                                            @endif
                    
                                            @if ($mudas->estagioMuda == 'Alto Padrão') 
                                                <option>Berçário</option>
                                                <option>Rustificação</option>
                                            @endif
                                    @else
                                        <option>Berçário</option>
                                        <option>Rustificação</option>
                                        <option>Alto Padrão</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Recipiente:</label>
                                <select id='idRecipientes' name="idRecipientes" class="custom-select" placeholder="Opcional">
                                        <option value=""></option>   
                                        @foreach ($Recipientes as $recipiente)
                                        <option @if($mudas->idRecipientes ?? '' == $recipiente->id) selected  @endif
                                            value="{{ $recipiente->id }}">{{ $recipiente->nome }}</option>
                                        @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Bloco de Plantio</label>
                                <select id='blocoPlantio' class="custom-select" type="text" name="blocoPlantio" placeholder="Obrigatório" required='ON'>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                    <option>E</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Canteiro de Plantio</label>
                                <input id='canteiroPlantio' class="form-control" type="number" min="1" max="20" name="canteiroPlantio" placeholder="Obrigatório" 
                                    value="{{$mudas->canteiroPlantio ?? old('canteiroPlantio')}}" required='ON'>
                            </div>
                        </div>
                        <div class="row">
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Taxa de Perda em %:</label>
                                <input class="form-control" type="number" min="1" max="100" name="taxaPerda" placeholder="Obrigatório" 
                                    value="{{$mudas->taxaPerda ?? old('taxaPerda')}}" required='ON'>
                            </div>
                            <div class="col-md-6">
                                <label>Data da Atualização:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input class="form-control" type="date" name="dataAtualizacao" placeholder="Opcional" 
                                    value="{{$mudas->dataAtualizacao ?? old('dataAtualizacao')}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <a id='moverMuda' type="submit" class="btn btn-primary" href="{{route('mudas.moverMuda', $value['id'])}}">Enviar</a>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
@Stop
