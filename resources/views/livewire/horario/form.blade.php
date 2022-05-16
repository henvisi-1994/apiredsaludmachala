<div class="modal-body">
    <div class="form-group" v-show="is_cargamasiva==false">
        <label>Fecha</label>
        <input  class="form-control" v-model="horario.fecha"  type="date">
            @error('horario') <span>{{$message}}
            </span>@enderror
    </div>

    <div class="form-group" v-show="is_cargamasiva==false">
        <label>Hora</label>
            <select name="Hora" class="form-control"v-model="horario.id_hora">
                <option v-for="hora in horas"v-bind:value="hora.id_hora">@{{hora.hora}}</option>
              </select>
    </div>
    <div class="form-group">
        <label>Centro Medico</label>
            <select name="CentroMedico" class="form-control"v-model="id_centroMedico" @input="obtener_especialidades($event)" >
                <option v-for="centroMedico in centros_medicos"v-bind:value="centroMedico.id_centroMedico">@{{centroMedico.nombre_centroMedico}}</option>
              </select>
    </div>
    <div class="form-group">
        <label>Especialidad</label>
            <select name="Especialidad" class="form-control"v-model="id_especialidad_m"  @input="obtener_medico($event)">
                <option v-for="especialidad in auxiliar"v-bind:value="especialidad.id_especialidad">@{{especialidad.nombre_especialidad}}</option>
              </select>
    </div>
    <div class="form-group">
        <label>Medico</label>
            <select name="Medico" class="form-control"v-model="horario.id_medico" >
                <option v-for="medico in auxiliar_m"v-bind:value="medico.id_medico">@{{medico.nombre_medico}}</option>
              </select>
    </div>
    <div class="form-group" v-show="is_cargamasiva==true">
        <label>Carga Archivo Masivo</label>
        <input  class="form-control" type="file" v-on:change="getArchivoCM">
    </div>
</div>
