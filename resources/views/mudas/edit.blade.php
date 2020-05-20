@extends('adminlte::page')

@section('content')
    
    <form action="{{ route ('mudas.update', $mudas->id)}}" method="post">
        @method('PUT')
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
            <h3 class="card-title">Edição do Registro da Muda " {{$mudas->nomePopular}} " </h3>
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