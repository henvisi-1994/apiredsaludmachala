<input type="text" v-model="search"  v-on:keyup.enter="buscar()" class="form-control" placeholder="Buscar"/>

<table id="turnos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Medico</th>
            <th>Especialidad</th>
            <th>Centro Medico</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="horario in horarios">
            <td>@{{horario.fecha}}</td>
            <td>@{{horario.hora.hora}}</td>
            <td>@{{horario.medico.nombre_medico}}</td>
            <td>@{{horario.medico.detalle.especialidad.nombre_especialidad}}</td>
            <td>@{{horario.medico.detalle.centro_medico.nombre_centroMedico}}</td>
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
<nav class="mt-2 d-flex "aria-label="Page navigation example">
    <ul class="pagination" v-for="link in links">
      <li class="page-item"><a class="page-link" v-if="link.label=='pagination.previous'" href="#" v-on:click.prevent="paginar_horario(link.url)"><</a>

    </li>
    <li class="page-item"><a class="page-link" v-if="link.label!=='pagination.previous' && link.label!=='pagination.next'" href="#" v-on:click.prevent="paginar_horario(link.url)">@{{link.label}}</a>

    </li>
    <li class="page-item"><a class="page-link" v-if="link.label=='pagination.next'" href="#" v-on:click.prevent="paginar_horario(link.url)">></a>

    </li>
    </ul>
  </nav>

