@extends('adminlte::page')

@section('title', 'Calificaciones')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Calificaciones</div>
</h1>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('content')
@livewire('calificacion-component')
@stop
