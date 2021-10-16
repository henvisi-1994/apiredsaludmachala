<div class="modal-body">
    <div class="form-group" v-if="tipo_medico=='Medico Fijo'">
        <label>Tipo de Medico</label>
            <select name="Tipo Medico" class="form-control"v-model="medico.tipo_medico"@input="obtener_tipo_medico($event)">
                <option value="Medico Fijo">Medico Fijo</option>
                <option value="Medico de Produccion">Medico de Produccion</option>
              </select>
    </div>
    <div class="form-group">
        <label>Nombre de Medico</label>
        <input  class="form-control" v-model="medico.nombre_medico" type="text">
            @error('nombre_medico') <span>{{$message}}
            </span>@enderror
    </div>
    <div class="form-group"v-if="tipo_medico=='Medico Fijo'">
        <label>Centro Medico</label>
            <select name="CentroMedico" class="form-control"v-model="id_centroMedico" @input="obtener_especialidades($event)" >
                <option v-for="centroMedico in centros_medicos"v-bind:value="centroMedico.id_centroMedico">@{{centroMedico.nombre_centroMedico}}</option>
              </select>
    </div>
    <div class="form-group"v-if="tipo_medico=='Medico Fijo'">
        <label>Especialidad</label>
            <select name="Especialidad" class="form-control"v-model="medico.id_detalleCentroMed">
                <option v-for="especialidad in auxiliar"v-bind:value="especialidad.id_detalleCentroMed">@{{especialidad.nombre_especialidad}}</option>
              </select>
    </div>
    <div class="form-group"v-if="tipo_medico=='Medico de Produccion'">
        <label>Especialidad</label>
            <select name="Especialidad" class="form-control"v-model="medico_prod.id_especialidad">
                <option v-for="especialidad in especialidades"v-bind:value="especialidad.id_especialidad">@{{especialidad.nombre_especialidad}}</option>
              </select>
    </div>

</div>
