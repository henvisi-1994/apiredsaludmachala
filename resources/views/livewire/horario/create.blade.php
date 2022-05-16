<div class="modal fade" id="modal-horarios">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title">Crear Horarios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <form enctype="multipart/form-data" method="POST" v-on:submit.prevent="createHorario">
                    @include('livewire.horario.form')

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit"  v-show="is_cargamasiva==false" class="btn btn-outline-primary" >Guardar</button>
                    </div>
                </form>

        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
