<div class="card-body">
    <div class="row">
        <div class="col-8">
            <label>Nome</label>
            <input class="form-control" type="text" name="nome" placeholder="Obrigatório" value="{{$substratos->nome ?? old('nome')}}">
        </div>
        <div class="col-md-2">
            <label>Quantidade</label>
            <input class="form-control" type="number" name="quant" placeholder="Obrigatório" value="{{$substratos->quant ?? old('quant')}}">
        </div>
        <div class="col-md-2">
            <label>Data da Coleta</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" type="date" name="inicioMaturacao" 
                        value="{{$substratos->inicioMaturacao ?? old('inicioMaturacao')}}">
                </div>
        </div>
    </div>
</div>
<div class="card-body">
        <label>Compostos Utilizados</label>
        <textarea class="form-control" rows="3" type="text" name="composto" placeholder="Obrigatório" value="{{$substratos->composto ?? old('composto')}}"></textarea>
</div>
<div class="card-body">
    <label>Observação</label>
    <textarea class="form-control" rows="3" type="text" name="observacao" placeholder="Opcional" 
        value="{{$substratos->observacao ?? old('observacao')}}"></textarea>
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('substratos.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>