@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Usuarios</div>
</h1>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('content')
@livewire('usuario-component')
@stop
