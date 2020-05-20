@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('mudas.store') }}" method="post">
    @csrf
    @if($errors->all())
        @foreach ($errors as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
        @endforeach
    @endif
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Mudas</h3>
        </div>
        @include('mudas.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop