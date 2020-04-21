@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('mudas.update',$mudas->id)}}" method="post">
    @method('PUT')
    @csrf
    @if(session()->has('stStatus'))
    <div class="@if(session()->get('stStatus')->stStatus){{'alert alert-sucess'}}@else{{'alert alert-error'}}@endif">
        <p>{{$stStatus->message}}</p>
    </div>
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