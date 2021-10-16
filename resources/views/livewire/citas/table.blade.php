<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Especialidad</th>
            <th>Medico</th>
            <th>Fecha</th>
            <th>Hora</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="cita in citas">
            <td>@{{cita.nombre_especialidad}}</td>
            <td>@{{cita.nombre_medico}}</td>
            <td>@{{cita.fecha}}</td>
            <td>@{{cita.hora}}</td>
        </tr>
    </tbody>
</table>
