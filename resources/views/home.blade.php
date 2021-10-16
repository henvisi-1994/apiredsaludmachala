@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido a la API de la Red de Salud de Machala.') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <img src="img/mujer con celular.png" class="img-fluid" alt="imagenmedicoconcelular">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

