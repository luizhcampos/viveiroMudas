@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('substratos.store') }}" method="post">
    @csrf
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Substratos</h3>
        </div>
        @include('substratos.formBasic')
    </div>
</form>

@stop