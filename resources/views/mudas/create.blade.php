@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('mudas.store') }}" method="post">
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