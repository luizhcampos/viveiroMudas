@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('substratos.update', $substratos->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Edição do Registro do Substrato " {{$substratos->nome}} " </h3>
        </div>
        @include('substratos.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop