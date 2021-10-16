<div class="modal-body">
    <div class="form-group">
        <label>Centro Medico</label>
        @{{nombre_centroMedico}}
    </div>
    <div class="form-group">
        <label>Especialidad</label>
            <select name="Especialidad" class="form-control"v-model="detalleCentroMedico.id_especialidad">
                <option v-for="especialidad in especialidades"v-bind:value="especialidad.id_especialidad">@{{especialidad.nombre_especialidad}}</option>
              </select>
    </div>
</div>
