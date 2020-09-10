@extends('adminlte::page')

@section('content')

<form action="{{ route ('sementes.update', $sementes->id)}}" method="post">
    @method('PUT')
    @if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endforeach 
    @elseif(session()->has('success')) 
        {{ session('success') }}
    @endif
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Edição do Registro da Semente " {{$sementes->nomePopular}} " </h3>
        </div>
        @include('sementes.formBasic')
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop