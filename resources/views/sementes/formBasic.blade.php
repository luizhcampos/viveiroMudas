<div class="card-body">
    <div class="row">
        <div class="col-4">
            <label>Nome Popular</label>
            <input class="form-control" type="text" name="nomePopular" placeholder="Obrigatório" value="{{$sementes->nomePopular ?? old('nomePopular')}}" required>
        </div>
        <div class="col-4">
            <label>Nome Científico</label>
            <input class="form-control" type="text" name="nomeCientifico" placeholder="Opcional" value="{{$sementes->nomeCientifico ?? old('nomeCientifico')}}">
        </div>
        <div class="col-md-2">
            <label>Peso 100 Un. em Kg</label>
            <input class="form-control" type="number" step="0.01" name="peso_100" placeholder="Obrigatório" value="{{$sementes->peso_100 ?? old('peso_100')}}" required>
        </div>
        <div class="col-md-2">
            <label>Peso em KG</label>
            <input class="form-control" type="number" step="0.01" name="quant_total" placeholder="Obrigatório" value="{{$sementes->quant_total ?? old('quant_total')}}" required>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-9">
            <label>Local da Coleta</label>
            <input class="form-control" type="text" name="localColeta" placeholder="Obrigatório" value="{{$sementes->localColeta ?? old('localColeta')}}" required>
        </div>
        <div class="col-md-3">
            <label>Data da Coleta</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input class="form-control" type="date" name="dataColeta" value="{{$sementes->dataColeta ?? old('dataColeta')}}" required>
                </div>
        </div>
    </div>
</div>
<div class="card-body">
    <label>Observação</label>
    <input class="form-control" max="1000" type="text" name="observacao" placeholder="Opcional" value="{{$sementes->observacao ?? old('observacao')}}">
</div>
<div class="card-body">
    <button id="salvar" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('sementes.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>