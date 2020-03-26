<div class="card-body">
    <div class="row">
        <div class="col-5">
            <label>Nome Popular</label>
            <input class="form-control" type="text" name="nomePopular" placeholder="Obrigatório" value="{{$sementes->nomePopular ?? old('nomePopular')}}">
        </div>
        <div class="col-5">
            <label>Nome Científico</label>
            <input class="form-control" type="text" name="nomeCientifico" placeholder="Opcional" value="{{$sementes->nomeCientifico ?? old('nomeCientifico')}}">
        </div>
        <div class="col-md-2">
            <label>Quantidade</label>
            <input class="form-control" type="number" name="quant" placeholder="Obrigatório" value="{{$sementes->quant ?? old('quant')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-10">
            <label>Local da Coleta</label>
            <input class="form-control" type="text" name="localColeta" placeholder="Opcional" value="{{$sementes->localColeta ?? old('localColeta')}}">
        </div>
        <div class="col-md-2">
            <label>Data da Coleta</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" type="date" name="dataColeta" value="{{$sementes->dataColeta ?? old('dataColeta')}}">
                </div>
        </div>
    </div>
</div>
<div class="card-body">
    <label>Observação</label>
    <textarea class="form-control" rows="3" type="text" name="observacao" placeholder="Opcional" value="{{$sementes->observacao ?? old('observacao')}}"></textarea>
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('sementes.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>