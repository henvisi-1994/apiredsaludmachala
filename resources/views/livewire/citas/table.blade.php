<input type="text" v-model="search_citas" class="form-control" placeholder="Buscar"/>
<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Centro Medico</th>
            <th>Especialidad</th>
            <th>Medico</th>
            <th>Fecha</th>
            <th>Hora</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="cita in buscar_citas()">
            <td>@{{cita.nombre_centroMedico}}</td>
            <td>@{{cita.nombre_especialidad}}</td>
            <td>@{{cita.nombre_medico}}</td>
            <td>@{{cita.fecha}}</td>
            <td>@{{cita.hora}}</td>
        </tr>
    </tbody>
</table>
