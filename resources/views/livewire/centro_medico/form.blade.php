<div class="modal-body">
    <div class="form-group">
        <label>Nombre de Centro Medico</label>
        <input  class="form-control" v-model="centro_medico.nombre_centroMedico" type="text">
            @error('nombre_centroMedico') <span>{{$message}}
            </span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea2">Direccion de Centro Medico</label>
        <textarea class="form-control rounded-0" v-model="centro_medico.direccion_centroMedico" id="exampleFormControlTextarea2" rows="3"></textarea>
        @error('direccion_centroMedico')<span>{{$message}}
    </span>@enderror
    </div>
    <div class="form-group">
        <label>Telefono</label>
        <input  class="form-control" v-model="centro_medico.telef_centroMedico" type="text">
            @error('telef_centroMedico') <span>{{$message}}
            </span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea2">EMail</label>
        <textarea class="form-control rounded-0" v-model="centro_medico.email" id="exampleFormControlTextarea2" rows="3"></textarea>
        @error('email')<span>{{$message}}
    </span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea2">Ubicacion de Centro Medico</label>
        <textarea class="form-control rounded-0" v-model="centro_medico.ubic_centroMedico" id="exampleFormControlTextarea2" rows="3"></textarea>
        @error('ubic_centroMedico')<span>{{$message}}
    </span>@enderror
    </div>
</div>



