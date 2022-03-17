<input type="text" v-model="search" class="form-control" placeholder="Buscar"/>
<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Medico</th>
            <th>Centro Medico</th>
            <th>Estado</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="horario in buscar()">
            <td>@{{horario.fecha}}</td>
            <td>@{{horario.hora}}</td>
            <td>@{{horario.nombre_medico}}</td>
            <td>@{{horario.nombre_centroMedico}}</td>
                                        <td>
                               <div v-if="horario.estado == true">
                                    <div class="p-1 mb-1 bg-success text-white text-center">
                                        Activo
                                    </div>
                                </div>
                                <div v-else-if="horario.estado == false">
                                    <div class="p-1 mb-1 bg-danger text-white text-center">
                                        Inactivo
                                    </div>
                                </div>
                            </td>
            <td v-if="horario.estado == true"><button class="btn btn-primary" v-on:click.prevent="editHorario(horario)"><i class="far fa-edit"></i></button></td>
            <td v-if="existe_cita_horario(horario.id_horario)"><button class="btn btn-success"  v-on:click.prevent="habilitar_horarios(horario.id_horario)"><i class="fas fa-toggle-on"></i></button></td>
            <td v-if="horario.estado == true"><button class="btn btn-danger" v-on:click.prevent="deleteHorario(horario.id_horario)"><i class="fas fa-trash"></i></button></td>
        </tr>
    </tbody>
</table>
