<div class="modal-body">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input  class="form-control" v-model="noticia.titulo_noticia" type="text">
                            @error('titulo_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input  class="form-control" v-model="noticia.descripcion_noticia" type="text">
                            @error('descripcion_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>

                    <div class="form-group">
                        <label>Imagen</label>
                        <input  class="form-control" v-model="noticia.imagen_noticia" type="text">
                            @error('imagen_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>

                   <!-- <x-adminlte-input-file name="imagen_noticia" wire:model="imagen_noticia" label="Imagen de Noticia" placeholder="Seleccione un archivo..." disable-feedback/>-->

                            <div class="form-group">
                            <label>Fecha de Inicio
                            </label>
                            <input type="datetime-local"  class="form-control"  v-model="noticia.fecha_inicio_noticia" >
                            @error('fecha_inicio_noticia') <span>{{$message}}
                            </span>@enderror
                            </div>
                            <div class="form-group">
                            <label>Fecha de Finalizacion
                            </label>
                    <input type="datetime-local" class="form-control"  v-model="noticia.fecha_fin_noticia"  >
                    @error('fecha_fin_noticia') <span>{{$message}}
                            </span>@enderror
                </div>
                </div>
