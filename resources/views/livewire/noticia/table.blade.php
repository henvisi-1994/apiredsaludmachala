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
        @foreach ($noticias as $noticia )
        <tr>
            <td>{{$noticia -> titulo_noticia}}</td>
            <td><img src="{{$noticia -> imagen_noticia}}" alt="" height="200"></td>
            <td>{{$noticia -> descripcion_noticia}}</td>
            <td>{{$noticia -> fecha_inicio_noticia}}</td>
            <td>{{$noticia -> fecha_fin_noticia}}</td>
            <td><button class="btn btn-primary" >editar</button></td>
            <td><button class="btn btn-danger" wire:click="destroy({{$noticia -> id_noticia}})">elininar</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$noticias->links()}}
