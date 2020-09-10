@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('substratos.update', $substratos->id)}}" method="post">
    @method('PUT')
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