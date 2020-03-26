@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('recipientes.update', $recipientes->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Edição do Registro do Recipientes " {{$recipientes->nome}} " </h3>
        </div>
        @include('recipientes.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop