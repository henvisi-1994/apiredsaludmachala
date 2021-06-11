<div class="modal-body">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input name="titulo_noticia" class="form-control" wire:model="titulo_noticia" type="text">
                            @error('titulo_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input name="descripcion_noticia" class="form-control" wire:model="descripcion_noticia" type="text">
                            @error('descripcion_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>

                    <div class="form-group">
                        <label>Imagen</label>
                        <input name="imagen_noticia" class="form-control" wire:model="imagen_noticia" type="text">
                            @error('imagen_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>

                   <!-- <x-adminlte-input-file name="imagen_noticia" wire:model="imagen_noticia" label="Imagen de Noticia" placeholder="Seleccione un archivo..." disable-feedback/>-->

                            <div class="form-group">
                            <label>Fecha de Inicio
                            </label>
                            <input type="text"  class="form-control" name="fecha_inicio_noticia" wire:model="fecha_inicio_noticia" value="2012-05-15 21:05" id="datetimepickeri">
                            @error('fecha_inicio_noticia') <span>{{$message}}
                            </span>@enderror
                            </div>
                            <div class="form-group">
                            <label>Fecha de Finalizacion
                            </label>
                    <input type="text" class="form-control" name="fecha_fin_noticia" wire:model="fecha_fin_noticia" value="2012-05-15 21:05" id="datetimepickerf">
                    @error('fecha_fin_noticia') <span>{{$message}}
                            </span>@enderror
                </div>
                </div>
