<div class="card-body">
    <div class="row">
        <div class="col-7">
            <label>Nome</label>
            <input class="form-control" type="text" name="nome" placeholder="Obrigatório" value="{{$substratos->nome ?? old('nome')}}">
        </div>
        <div class="col-md-2">
            <label>Quant. Litros</label>
            <input class="form-control" type="number"  step="0.01"  name="quant" placeholder="Obrigatório" value="{{$substratos->quant ?? old('quant')}}" required>
        </div>
        <div class="col-md-3">
            <label>Data do Cadastro</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input class="form-control" type="date" name="inicioMaturacao" 
                        value="{{$substratos->inicioMaturacao ?? old('inicioMaturacao')}}" required>
                </div>
        </div>
    </div>
</div>
<div class="card-body">
        <label>Compostos Utilizados</label>
        <input class="form-control" rows="3" type="text" name="composto" placeholder="Obrigatório" value="{{$substratos->composto ?? old('composto')}}" required>
</div>
<div class="card-body">
    <label>Observação</label>
    <input class="form-control" rows="3" type="text" name="observacao" placeholder="Opcional" 
        value="{{$substratos->observacao ?? old('observacao')}}">
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('substratos.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>