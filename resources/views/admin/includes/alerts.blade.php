<!--Validar Planos-->

@if ($errors->any()) 
    <!--fará a impressão dos erros-->
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
