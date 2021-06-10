@extends('adminlte::page')

@section('title', 'Noticias')

@section('content_header')
<h1>
    <div class="mt-2 mb-2 ">Noticias</div>
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-create-category">
        Nuevo
    </button>
</h1>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('content')
@livewire('noticia-component')
@stop


@section('js')
<script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<script>
$('#datetimepickeri').datetimepicker({
    format: 'yyyy-mm-dd hh:ii'
});
$('#datetimepickerf').datetimepicker({
    format: 'yyyy-mm-dd hh:ii'
});
$(document).ready(function() {
    $('#categories').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>
@stop