@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('users.store') }}" method="post">
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Funcionários</h3>
        </div>
        @include('users.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop