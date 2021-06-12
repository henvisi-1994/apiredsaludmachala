<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Imagen</th>
            <th>Descripciòn</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="noticia in noticias">
            <td>@{{noticia.titulo_noticia}}</td>
            <td><img :src="noticia.imagen_noticia" class="image-fluid img-thumbnail"></td>

            <td>@{{noticia.descripcion_noticia}}</td>
            <td>@{{noticia.fecha_inicio_noticia}}</td>
            <td>@{{noticia.fecha_fin_noticia}}</td>
            <td><button class="btn btn-primary" v-on:click.prevent="editNoticia(noticia)">Editar</button></td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteNoticia(noticia.id_noticia)">Eliminar</button></td>
        </tr>

    </tbody>
</table>

