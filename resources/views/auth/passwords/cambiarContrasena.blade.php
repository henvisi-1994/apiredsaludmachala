@extends('adminlte::page')
@section('title', 'Cambiar Contraseña')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Cambiar Contraseña</div>
</h1>
@stop
@section('content')
<form method="POST" v-on:submit.prevent="cambiarPassword">

<div class="form-group">
    <label>Contraseña Anterior</label>
    <input  class="form-control" v-model="change_password.password_old" type="password">
</div>
<div class="form-group">
    <label>Contraseña Nueva</label>
    <input  class="form-control" v-model="change_password.password_new"  type="password">
</div>
<div class="form-group">
    <label>Confirmar Contraseña</label>
    <input  class="form-control" v-model="change_password.password_confirm" type="password">
</div>
<div class="col text-center">
    <button class="btn btn-primary" type="submit">GUARDAR</button>
</div>
</form>
@stop
