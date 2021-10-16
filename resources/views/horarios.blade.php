@extends('adminlte::page')

@section('title', 'Horarios')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Horarios</div>
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-horarios">
        Nuevo
    </button>
</h1>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('content')
@livewire('horario-component')
@stop
