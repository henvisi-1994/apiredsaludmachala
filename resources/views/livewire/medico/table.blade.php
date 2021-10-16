<div>
    <b-tabs content-class="mt-3">
      <b-tab title="Medicos de Red de Salud" active>
          <table id="categories" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre Medico</th>
                <th>Tipo Medico</th>
                <th>Centro Medico</th>
                <th>Especialidad</th>

                <th colspan="2">&nbsp;</th>
            </tr>
        </thead>
        <tbody>

            <tr v-for="medico in medicos">
                <td>@{{medico.nombre_medico}}</td>
                <td>@{{medico.tipo_medico}}</td>
                <td>@{{medico.nombre_centroMedico}}</td>
                <td>@{{medico.nombre_especialidad}}</td>



                <td><button class="btn btn-primary" v-on:click.prevent="editMedico(medico)"><i class="far fa-edit"></i></button></td>
                <td><button class="btn btn-danger" v-on:click.prevent="deleteMedico(medico.id_medico)"><i class="fas fa-trash"></i></button></td>
            </tr>
        </tbody>
    </table>
</b-tab>
      <b-tab title="Medicos de Produccion">
        <table id="prod" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre Medico</th>
                    <th>Especialidad</th>

                    <th colspan="2">&nbsp;</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="medico in medicos_prod">
                    <td>@{{medico.nombre_medico}}</td>
                    <td>@{{medico.nombre_especialidad}}</td>
                    <td><button class="btn btn-primary" v-on:click.prevent="editMedicoProd(medico)"><i class="far fa-edit"></i></button></td>
                    <td><button class="btn btn-danger" v-on:click.prevent="deleteMedicoProd(medico.id_medico_prod)"><i class="fas fa-trash"></i></button></td>
                </tr>
            </tbody>
        </table>

      </b-tab>
    </b-tabs>
  </div>
