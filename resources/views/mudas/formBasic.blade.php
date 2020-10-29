<div class="card-body">
    <div class="row">
        <div class="col-4">
            <label>Nome Popular</label>
            <input class="form-control" type="text" name="nomePopular" placeholder="Obrigatório" 
            value="{{$mudas->nomePopular ?? old('nomePopular')}}" required='ON'>
        </div>
        <div class="col-4">
            <label>Nome Científico</label>
            <input class="form-control" type="text" name="nomeCientifico" placeholder="Opcional" value="{{$mudas->nomeCientifico ?? old('nomeCientifico')}}">
        </div>
        <div class="col-md-4">
            <label>Data de Plantio</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input class="form-control" type="date" name="dataPlantio" placeholder="Obrigatório" value="{{$mudas->dataPlantio ?? old('dataPlantio')}}" required>
                </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <label>Quantidade</label>
            <input class="form-control" type="number" name="quant" placeholder="Obrigatório" value="{{$mudas->quant ?? old('quant')}}" required='ON'>
        </div>        
        <div class="col-md-3">
            <label>Finalidade de Plantio</label>
            <select class="custom-select" type="text" name="tipoPlantio" placeholder="Obrigatório" value="" required>
                @if ($mudas->tipoPlantio ?? '' != '')

                        <option value="{{$mudas->tipoPlantio}}">{{$mudas->tipoPlantio}}</option>
                                
                        @if ($mudas->tipoPlantio == 'Frutífera')
                            <option>Restauração</option>
                            <option>Arborização</option>
                        @endif
                        
                        @if ($mudas->tipoPlantio == 'Restauração')
                            <option>Frutífera</option>
                            <option>Arborização</option>
                        @endif

                        @if ($mudas->tipoPlantio == 'Arborização') 
                            <option>Restauração</option>
                            <option>Arborização</option>
                        @endif
                @else
                    <option>Frutífera</option>
                    <option>Restauração</option>
                    <option>Arborização</option>
                @endif
            </select> 
        </div>
        <div class="col-md-2">
            <label>Bloco de Plantio</label>
            <select class="custom-select" type="text" name="blocoPlantio" placeholder="Obrigatório" required='ON'>
                <option value="A" <?=($mudas->blocoPlantio == 'A')?'selected':''?> >A</option>
                <option value="B" <?=($mudas->blocoPlantio == 'B')?'selected':''?> >B</option>
                <option value="C" <?=($mudas->blocoPlantio == 'C')?'selected':''?> >C</option>
                <option value="D" <?=($mudas->blocoPlantio == 'D')?'selected':''?> >D</option>
                <option value="E" <?=($mudas->blocoPlantio == 'E')?'selected':''?> >E</option>

            </select>
        </div>
        <div class="col-md-2">
            <label>Canteiro de Plantio</label>
            <input class="form-control" type="number" min="1" max="20" name="canteiroPlantio" placeholder="Obrigatório" 
                value="{{$mudas->canteiroPlantio ?? old('canteiroPlantio')}}" required='ON'>
        </div>
        <div class="col-md-2">
            <label>Estágio de Produção</label>
            <select class="custom-select" type="text" name="estagioMuda" placeholder="Obrigatório" required='ON' value="">
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
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <label>Recipiente</label>
            <select name="idRecipientes" class="custom-select" placeholder="Obrigatório">
                    <option value=""></option>   
                    @foreach ($Recipientes as $recipiente)
                    <option @if($mudas->idRecipientes == $recipiente->id) selected  @endif
                        value="{{ $recipiente->id }}"> Lote {{$recipiente->id}} | {{ $recipiente->nome }}</option>
                    @endforeach    
            </select>
        </div>
        <div class="col-md-3">
            <label>Substratos</label>
            <select name="idSubstratos" class="custom-select" placeholder="Obrigatório">
                <option value=""></option>   
                @foreach ($Substratos as $substrato)
                <option @if($mudas->idSubstratos == $substrato->id) selected  @endif
                    value="{{$substrato->id}}" > Lote {{$substrato->id}} | {{$substrato->nome}}</option>
                @endforeach     
            </select> 
        </div>
        <div class="col-md-3">
            <label>Substrato gasto no Plantio</label>
            <input name="volume_Subs_Recip" value="{{$mudas->volume_Subs_Recip ?? old('volume_Subs_Recip')}}" 
            class="custom-select" type="number" step="0.01" placeholder="Obrigatório"> 
        </div>
        <div class="col-md-3">
            <label>Semente</label>
            <select name="idSementes" class="custom-select" placeholder="Obrigatório">
                <option value=""></option>   
                @foreach ($Sementes as $semente)
                <option @if($mudas->idSementes == $semente->id) selected  @endif
                    value="{{$semente->id}}" > Lote {{$semente->id}} | {{$semente->nomePopular}}</option>
                @endforeach     
            </select> 
        </div>
    </div>
</div>

<div class="card-body">
    <label>Observação</label>
    <input class="form-control" type="text" name="observacao" placeholder="Opcional" value="{{$mudas->observacao ?? old('observacao')}}">
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('mudas.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>