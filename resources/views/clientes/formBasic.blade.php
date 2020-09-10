<div class="card-body">
    <div class="row">
        <div class="col-8">
            <label>Nome / Empresa</label>
            <input id="nome" class="form-control" type="text" name="nome" placeholder="Obrigatório" required="ON" value="{{$clientes->nome ?? old('nome')}}">
        </div>
        <div class="col-md-4">
            <label>CPF / CNPJ</label>
            <input class="form-control" type="number" name="CPF" placeholder="Opcional"  value="{{$clientes->CPF ?? old('CPF')}}">
        </div>
    </div>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <label>Rua</label>
            <input class="form-control" type="text" name="rua" placeholder="Opcional" value="{{$clientes->rua ?? old('rua')}}">
        </div>
        <div class="col-md-3">
            <label>Número</label>
            <input class="form-control" type="number" name="num" placeholder="Opcional" 
                value="{{$clientes->num ?? old('num')}}">
        </div>
        <div class="col-md-3">
            <label>Bairro</label>
            <input class="form-control" type="text" name="bairro" placeholder="Opcional" value="{{$clientes->bairro ?? old('bairro')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <label>Cidade</label>
            <input class="form-control" type="text" name="cidade" placeholder="Obrigatório" required="ON" value="{{$clientes->cidade ?? old('cidade')}}">
        </div>
        <div class="col-md-3">
            <label>CEP</label>
            <input class="form-control" type="number" name="cep" placeholder="Opcional" 
                value="{{$clientes->cep ?? old('cep')}}">
        </div>
        <div class="col-md-3">
            <label>Estado</label>
            <input class="form-control" type="text" name="uf" placeholder="Obrigatório" required="ON" value="{{$clientes->uf ?? old('uf')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('clientes.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>