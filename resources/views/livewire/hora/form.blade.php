<div class="modal-body">
    <div class="form-group">
        <label>Hora</label>
        <input  class="form-control" v-model="hora.hora" type="text">
            @error('hora') <span>{{$message}}
            </span>@enderror
    </div>
</div>
