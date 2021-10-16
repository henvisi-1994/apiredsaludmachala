<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Medico</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="horario in horarios">
            <td>@{{horario.fecha}}</td>
            <td>@{{horario.hora}}</td>
            <td>@{{horario.nombre_medico}}</td>
            <td><button class="btn btn-primary" v-on:click.prevent="editHorario(horario)"><i class="far fa-edit"></i></button></td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteHorario(horario.id_horario)"><i class="fas fa-trash"></i></button></td>
        </tr>
    </tbody>
</table>
