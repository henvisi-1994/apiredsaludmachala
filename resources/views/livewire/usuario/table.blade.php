<input type="text" v-model="search_usuario" v-on:keyup.enter="buscar_usuario()" class="form-control" placeholder="Buscar"/>
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

        <tr v-for="usuario in usuarios">
            <td>@{{usuario.name}}</td>
            <td>@{{usuario.email}}</td>
            <td>@{{usuario.telefono}}</td>
            <td>@{{usuario.identificacion}}</td>
            <td>@{{usuario.direccion}}</td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteUsuario(usuario.id)"><i class="fas fa-trash"></i></button></td>
        </tr>

    </tbody>
</table>
<nav class="mt-2 d-flex "aria-label="Page navigation example">
    <ul class="pagination" v-for="link in links_user">
      <li class="page-item"><a class="page-link" v-if="link.label=='pagination.previous'" href="#" v-on:click.prevent="paginar_usuario(link.url)"><</a>

    </li>
    <li class="page-item"><a class="page-link" v-if="link.label!=='pagination.previous' && link.label!=='pagination.next'" href="#" v-on:click.prevent="paginar_usuario(link.url)">@{{link.label}}</a>

    </li>
    <li class="page-item"><a class="page-link" v-if="link.label=='pagination.next'" href="#" v-on:click.prevent="paginar_usuario(link.url)">></a>

    </li>
    </ul>
  </nav>
