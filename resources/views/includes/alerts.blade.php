@if(session('success'))
    <script>
        alert('Sucesso');
    </script>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif