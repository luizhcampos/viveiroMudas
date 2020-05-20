@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('clientes.update', $clientes->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Edição do Registro do Cliente " {{$clientes->nome}} " </h3>
        </div>
        @include('clientes.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop