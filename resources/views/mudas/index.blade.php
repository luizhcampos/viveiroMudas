@extends('adminlte::page')

@section('js')
<!-- Include a required theme -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>

        $('#enviarMovimento').on('click', function (event){
            event.preventDefault();
            var id = $('#id').val();

            var quant = $('#QuantAtual').val();

            if (quant == 0){
                swal.fire("Verifique", "Campo de Quantidade Atual Inválido", "info");
                document.quant.focus(); 
                   
            }

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (id != '') {
                
                $.ajax(
                    {
                        method: 'POST',
                        url: 'muda/moverMuda',
                        dataType: 'JSON',
                        data: {
                            id: $('#id').val(),
                            blocoPlantio: $('#blocoPlantio').val(),
                            taxaPerda: $('#taxaPerda').val(),
                            canteiroPlantio: $('#canteiroPlantio').val(),
                            dataAtualizacao: $('#dataAtualizacao').val(),
                            estagioMuda: $('#estagioMuda').val(),
                            nomePopular: $('#nomePopular').val(),
                            quant: $('#QuantAtual').val(),
                        },        
                        success: function(data) {
                            $('#moverMudas').modal('hide');       
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Muda Movimentada com Sucesso!',
                                showConfirmButton: false,
                                timer: 1500,
                                onClose: () => {    
                                    window.location.reload()
                                    }
                            });
                        },
                        error: function(xhr,textStatus,thrownError) {
                            alert(xhr + "\n" + textStatus + "\n" + thrownError);
                        }
                    });
            }
        });


        $(document).on('click', '.view_data', function () {
            event.preventDefault();
            var id = $(this).attr("id");
            if (id != 'enviarMovimento'){
                $.ajax({
                    url: 'buscar/'+id,
                    type: 'GET',
                    dataType:'JSON',
                    success: function (data) {
                        $('#id').val(data.id);
                        $('#blocoPlantio').val(data.blocoPlantio);
                        $('#taxaPerda').val(data.taxaPerda);
                        $('#canteiroPlantio').val(data.canteiroPlantio);
                        $('#dataAtualizacao').val(data.dataAtualizacao);
                        $('#estagioMuda').val(data.estagioMuda);
                        $('#nomePopular').val(data.nomePopular);
                        $('#QuantMudas').val(data.quant);
                        $('#moverMudas').modal('show');
                    }
                });
            }
        });

        function AtualizaPerda(Request){
            var QuantAtual = Request.value;
               
            var QuantAnt = document.getElementById('QuantMudas').value;
            if (parseFloat(QuantAtual) > parseFloat(QuantAnt)){
                swal.fire("Verifique", "Quantidade Atual não pode ser maior que a Quantidade anterior", "info");

                document.getElementById('QuantAtual').value = QuantAnt; 

                //document.Request.QuantAtual.focus();     
            }

            var ValorF = ((QuantAtual * 100)/QuantAnt);

            if (ValorF != 0){
                ValorF = 100 - ValorF;
            }
            else{
                ValorF = 0;
            }

            document.getElementById('taxaPerda').value = ValorF.toFixed(2); 
        };

    </script>
@stop

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
                            Idade do Lote
                        </th>
                        <th>
                            Custo de Produção
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
                                if ($value['dataPlantio'] != null) {
                                    echo date_format(new DateTime($value['dataPlantio']), "d/m/Y");
                                }
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                @php
                                    $data1 = new DateTime('now');
                                    $data2 = new DateTime($value['dataPlantio']);
                                    $intervalo = $data1->diff($data2);
                                    echo $intervalo->format('%a dias');
                                @endphp
                            </a>
                        </td>
                        <td >
                            <a>
                                {{ 'R$ ' .$value['custoProducao']}}
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
                            <a class="btn btn-danger btn-sm" href="{{route('mudas.deletar', $value['id'])}}">
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
                {!! $mudas->appends($filters)->links() !!}
            @else
                {!! $mudas->links() !!}
            @endif
                
        </div>
      <!-- /.card -->
    </section>

    <div class="modal fade" id="moverMudas" tabindex="-1" role="dialog" aria-labelledby="modalMudas" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" >Movimentando a Muda 
                    <input class="form-control-plaintext" id="id" value="id" disabled>
                </h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="movendoMudas">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nome Popular</label>
                                <input id='nomePopular' class="form-control" type="text" name="nomePopular"
                                value="{{$mudas->nomePopular ?? old('nomePopular')}}" disabled>
                            </div>
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
                            <div class="col-md-6">
                                <label>Quantidade Anterior:</label>
                                <input id='QuantMudas' class="form-control" type="text" disabled>
                            </div> 
                            <div class="col-md-6">
                                <label>Quantidade Atual:</label>
                                <input id="QuantAtual"  class="form-control" onchange="AtualizaPerda(this)" type="number" min="1" name="QuantAtual"
                                 placeholder="Obrigatório">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Taxa de Perda em %:</label>
                                <input id="taxaPerda"  disabled class="form-control" type="number" min="1" max="100" name="taxaPerda"
                                 placeholder="Obrigatório" value="{{$mudas->taxaPerda ?? old('taxaPerda')}}" required='ON'>
                            </div>
                            <div class="col-md-6">
                                <label>Data da Atualização:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input class="form-control" type="date"  id="dataAtualizacao"  name="dataAtualizacao" placeholder="Opcional" 
                                    value="{{$mudas->dataAtualizacao ?? old('dataAtualizacao')}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button id="enviarMovimento" class="btn btn-primary view_data">Enviar</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
@Stop
