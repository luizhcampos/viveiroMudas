<div class="card-body">
    <div class="row">
        <div class="col-8">
            <label>Nome</label>
            <input class="form-control" type="text" name="nome" placeholder="Obrigatório" value="{{$recipientes->nome ?? old('nome')}}">
        </div>
        <div class="col-md-4">
            <label>Quantidade</label>
            <input class="form-control" type="number" name="quant" placeholder="Obrigatório" value="{{$recipientes->quant ?? old('quant')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <label>Observação</label>
    <input class="form-control" rows="3" type="text" name="observacao" placeholder="Opcional" 
        value="{{$recipientes->observacao ?? old('observacao')}}">
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('recipientes.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>