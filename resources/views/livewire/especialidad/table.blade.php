<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Valor</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="especialidad in especialidades">
            <td>@{{especialidad.nombre_especialidad}}</td>
            <td>@{{especialidad.valor}}</td>
            <td><button class="btn btn-primary" v-on:click.prevent="editEspecialidad(especialidad)"><i class="far fa-edit"></i></button></td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteEspecialidad(especialidad.id_especialidad)"><i class="fas fa-trash"></i></button></td>
        </tr>
    </tbody>
</table>
