@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('clientes.store') }}" method="post">
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Clientes</h3>
        </div>
        @include('clientes.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop