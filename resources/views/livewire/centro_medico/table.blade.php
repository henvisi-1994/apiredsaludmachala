<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Ubicacion</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="centro_medico in centros_medicos">
            <td>@{{centro_medico.nombre_centroMedico}}</td>
            <td>@{{centro_medico.direccion_centroMedico}}</td>
            <td>@{{centro_medico.telef_centroMedico}}</td>
            <td>@{{centro_medico.email}}</td>
            <td>@{{centro_medico.ubic_centroMedico}}</td>
            <td><button class="btn btn-primary" v-on:click.prevent="editCentroMedico(centro_medico)"><i class="far fa-edit"></i></button></td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteCentroMedico(centro_medico.id_centroMedico)"><i class="fas fa-trash"></i></button></td>
        </tr>
    </tbody>
</table>

