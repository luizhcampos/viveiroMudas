@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('sementes.store') }}" method="post">
    @if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endforeach 
    @elseif(session()->has('success')) 
        <div id="msg" class="alert alert-sucess">                
            <p>{{$st->message}}</p>
        </div>
    @endif
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Sementes</h3>
        </div>
        @include('sementes.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop