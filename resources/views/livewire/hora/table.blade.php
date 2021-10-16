<table id="categories" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Hora</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr v-for="hora in horas">
            <td>@{{hora.hora}}</td>
            <td><button class="btn btn-primary" v-on:click.prevent="editHora(hora)"><i class="far fa-edit"></i></button></td>
            <td><button class="btn btn-danger" v-on:click.prevent="deleteHora(hora.id_hora)"><i class="fas fa-trash"></i></button></td>
        </tr>
    </tbody>
</table>
