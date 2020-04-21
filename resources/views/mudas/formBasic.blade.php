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
            <label>Data da Coleta</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input class="form-control" type="date" name="dataPlantio" placeholder="Opcional" value="{{$mudas->dataPlantio ?? old('dataPlantio')}}">
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
            <label>Preço</label>
            <input class="form-control" type="number" step="0.01" name="precoMuda" placeholder="Obrigatório" 
                value="{{$mudas->precoMuda ?? old('precoMuda')}}" required='ON'>
        </div>
        <div class="col-md-2">
            <label>Bloco de Plantio</label>
            <select class="custom-select" type="text" name="blocoPlantio" placeholder="Obrigatório" required='ON'>
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
                <option>E</option>
            </select>
        </div>
        <div class="col-md-2">
            <label>Canteiro de Plantio</label>
            <input class="form-control" type="number" min="1" max="20" name="canteiroPlantio" placeholder="Obrigatório" 
                value="{{$mudas->canteiroPlantio ?? old('canteiroPlantio')}}" required='ON'>
        </div>
        <div class="col-md-2">
            <label>Estágio de Produção</label>
            <select class="custom-select" type="text" name="estagioMuda" placeholder="Obrigatório" 
                    value="{{$mudas->estagioMuda ?? old('estagioMuda')}}" required='ON'>
                <option>Berçário</option>
                <option>Rustificação</option>
                <option>Alto Padrão</option>
            </select>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <label>Recipiente</label>
            <select name="idRecipientes" class="custom-select" placeholder="Obrigatório" required="ON">
                    <option value=""></option>   
                    @foreach ($Recipientes as $recipiente)
                    <option @if($mudas->idRecipientes ?? '' == $recipiente->id) selected  @endif
                        value="{{ $recipiente->id }}">{{ $recipiente->nome }}</option>
                    @endforeach    
            </select>
        </div>
        <div class="col-md-3">
            <label>Substratos</label>
            <select name="idSubstratos" class="custom-select" placeholder="Obrigatório" required="ON">
                <option value=""></option>   
                @foreach ($Substratos as $substrato)
                <option @if($mudas->idSubstratos ?? '' == $substrato->id) selected  @endif
                    value="{{$substrato->id}}" > {{$substrato->nome}}</option>
                @endforeach     
            </select> 
        </div>
        <div class="col-md-3">
            <label>Tipo de Plantio</label>
            <input class="form-control" type="text" name="tipoPlantio" placeholder="Opcional" value="{{$mudas->tipoPlantio ?? old('tipoPlantio')}}">
        </div>
        <div class="col-md-3">
            <label>Semente</label>
            <select name="idSementes" class="custom-select" placeholder="Obrigatório" required="ON">
                <option value=""></option>   
                @foreach ($Sementes as $semente)
                <option @if($mudas->idSementes ?? '' == $semente->id) selected  @endif
                    value="{{$semente->id}}" > {{$semente->nomePopular}}</option>
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