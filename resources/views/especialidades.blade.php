@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Especialidades</div>
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-especialidades">
        Nuevo
    </button>
</h1>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('content')
@livewire('especialidad-component')
@stop
