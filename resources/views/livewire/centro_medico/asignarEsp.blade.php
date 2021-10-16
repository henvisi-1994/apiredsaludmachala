<div class="modal fade" id="modal-asignarEspecialidad">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title">Asignar Especialidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <form enctype="multipart/form-data" method="POST">
                    @include('livewire.centro_medico.formAsignarEsp')

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="button" v-on:click="createDetalleCentromedico" class="btn btn-outline-primary" >Guardar</button>
                    </div>
                </form>
                <table id="categories" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Centro Medico</th>
                            <th>Especialidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="detalle_centro_medico in auxiliar">
                            <td>@{{detalle_centro_medico.nombre_centroMedico}}</td>
                            <td>@{{detalle_centro_medico.nombre_especialidad}}</td>
                            <td><button class="btn btn-danger" v-on:click.prevent="deleteAsigEspec(detalle_centro_medico.id_detalleCentroMed)"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>

        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
