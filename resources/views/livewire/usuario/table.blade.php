<input type="text" v-model="search_usuario" class="form-control" placeholder="Buscar"/>
<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Identificacion</th>
            <th>Direccion</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="usuario in buscar_usuario()">
            <td>@{{usuario.name}}</td>
            <td>@{{usuario.email}}</td>
            <td>@{{usuario.telefono}}</td>
            <td>@{{usuario.identificacion}}</td>
            <td>@{{usuario.direccion}}</td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteUsuario(usuario.id)"><i class="fas fa-trash"></i></button></td>
        </tr>

    </tbody>
</table>

