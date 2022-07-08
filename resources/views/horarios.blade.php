@extends('adminlte::page')

@section('title', 'Horarios')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Horarios</div>
    <button type="button" class="btn btn-primary " v-on:click.prevent="abrir_nuevo()">
        Nuevo
    </button>
    <button type="button" class="btn btn-success " v-on:click.prevent="carga_masiva()">
        Carga Masiva de Turnos
    </button>
</h1>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/red_salud/turnos/turnos.js"></script>
@endsection

@section('content')
@livewire('horario-component')
@stop
