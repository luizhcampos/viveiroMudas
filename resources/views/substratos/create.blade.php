@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('substratos.store') }}" method="post">
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
          <h3 class="card-title">Cadastro de Substratos</h3>
        </div>
        @include('substratos.formBasic')
    </div>
</form>

@stop