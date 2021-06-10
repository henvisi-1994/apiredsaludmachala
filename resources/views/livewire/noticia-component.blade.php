<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de noticias</h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('livewire.noticia.table')
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<!-- modal -->
<div class="modal fade" id="modal-create-category">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title">Crear Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>

            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">
                        <x-adminlte-input name="iLabel" label="Titulo" placeholder="Ingrese el titulo de la noticia"
                            fgroup-class="col-md-6" disable-feedback/>
                    </div>
                    <x-adminlte-textarea name="taDesc" label="Descripciòn" rows=5 label-class="text-primary" igroup-size="sm" placeholder="Ingrese descripciòn de la noticia...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-lg fa-file-alt text-primary"></i>
                        </div>
                    </x-slot>
                    </x-adminlte-textarea>
                    <x-adminlte-input-file name="ifLabel" label="Imagen de Noticia" placeholder="Seleccione un archivo..." disable-feedback/>
                    <input type="text" value="2012-05-15 21:05" id="datetimepickeri">
                    <input type="text" value="2012-05-15 21:05" id="datetimepickerf">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary">Guardar</button>
                </div>
            </form>

        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
