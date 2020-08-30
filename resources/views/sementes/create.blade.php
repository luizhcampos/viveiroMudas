@extends('adminlte::page')

@section('content')
    
<form action="{{ route ('sementes.store') }}" method="post">
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
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script>
    document.getElementById("salvar").onclick = function (){
        alert('Teste Salvando');
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
            )
    }
</script>
@stop