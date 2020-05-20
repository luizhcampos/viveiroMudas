<div class="card-body">
    <div class="row">
        <div class="col-12">
            <label>Nome</label>
            <input class="form-control" type="text" name="name" placeholder="Obrigatório" required="ON" value="{{$users->name ?? old('name')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <label>E-mail</label>
            <input class="form-control" type="text" name="email" placeholder="Obrigatório" required="ON" value="{{$users->email ?? old('email')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <label>Senha</label>
            <input class="form-control" type="text" name="password" placeholder="Obrigatório" required="ON" value="{{$users->password ?? old('password')}}">
        </div>
    </div>
</div>
<div class="card-body">
    <button type="submit" class="btn btn-block btn-outline-success btn-lg">Salvar</button>
    <a type="button" href={{route('users.index')}} class="btn btn-block btn-outline-danger btn-lg">Cancelar</a>
</div>