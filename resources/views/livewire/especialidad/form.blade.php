<div class="modal-body">
    <div class="form-group">
        <label>Nombre de Especialidad</label>
        <input  class="form-control" v-model="especialidad.nombre_especialidad" type="text">
            @error('nombre_especialidad') <span>{{$message}}
            </span>@enderror
    </div>
    <div class="form-group">
        <label>Valor</label>
        <input  class="form-control" type="number" step="any" v-model="especialidad.valor" type="text">
            @error('valor') <span>{{$message}}
            </span>@enderror
    </div>
</div>
