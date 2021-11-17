<div class="modal-body">
    <div class="form-group">
        <label>Fecha</label>
        <input  class="form-control" v-model="horario.fecha" type="date">
            @error('horario') <span>{{$message}}
            </span>@enderror
    </div>
    <div class="form-group">
        <label>Hora</label>
            <select name="Hora" class="form-control"v-model="horario.id_hora">
                <option v-for="hora in horas"v-bind:value="hora.id_hora">@{{hora.hora}}</option>
              </select>
    </div>
    <div class="form-group">
        <label>Medico</label>
            <select name="Medico" class="form-control"v-model="horario.id_medico">
                <option v-for="medico in medicos"v-bind:value="medico.id_medico">@{{medico.nombre_medico}} - @{{medico.nombre_centroMedico}}</option>
              </select>
    </div>
</div>
