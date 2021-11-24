<input type="text" v-model="search_calificacion" class="form-control" placeholder="Buscar"/>
<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Centro Medico</th>
            <th>Especialidad</th>
            <th>Medico</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Calificacion</th>
            <th>Comentario</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="calificacion in buscar_calificaciones()">
            <td>@{{calificacion.nombre_centroMedico}}</td>
            <td>@{{calificacion.nombre_especialidad}}</td>
            <td>@{{calificacion.nombre_medico}}</td>
            <td>@{{calificacion.fecha}}</td>
            <td>@{{calificacion.hora}}</td>
            <td>@{{calificacion.calificacion}}</td>
            <td>@{{calificacion.comentario}}</td>
        </tr>
    </tbody>
</table>
