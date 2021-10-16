<div class="modal-body">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input  class="form-control" v-model="noticia.titulo_noticia" type="text">
                            @error('titulo_noticia') <span>{{$message}}
                            </span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea2">Descripcion</label>
                        <textarea class="form-control rounded-0" v-model="noticia.descripcion_noticia" id="exampleFormControlTextarea2" rows="3"></textarea>
                        @error('descripcion_noticia')<span>{{$message}}
                    </span>@enderror
                    </div>

                    <div class="form-group files">
                        <label>
                            Imagen
                        </label>
                        <input class="form-control"  name="imagen_noticia" type="file" v-on:change="getImagenNoticia" >                             </input>
                    </div>

                   <!-- <x-adminlte-input-file name="imagen_noticia" wire:model="imagen_noticia" label="Imagen de Noticia" placeholder="Seleccione un archivo..." disable-feedback/>-->

                            <div class="form-group">
                            <label>Fecha de Inicio
                            </label>
                            <input type="date"  class="form-control"  v-model="noticia.fecha_inicio_noticia" >
                            @error('fecha_inicio_noticia') <span>{{$message}}
                            </span>@enderror
                            </div>

                            <div class="form-group">
                                <label>Hora de Inicio
                                </label>
                                <input type="time"  class="form-control"  v-model="noticia.hora_inicio_noticia" >
                                @error('hora_inicio_noticia') <span>{{$message}}
                                </span>@enderror
                                </div>

                            <div class="form-group">
                            <label>Fecha de Finalizacion
                            </label>
                    <input type="date" class="form-control"  v-model="noticia.fecha_fin_noticia"  >
                    @error('fecha_fin_noticia') <span>{{$message}}
                            </span>@enderror
                </div>

                <div class="form-group">
                    <label>Hora de Finalizacion
                    </label>
                    <input type="time"  class="form-control"  v-model="noticia.hora_fin_noticia" >
                    @error('hora_fin_noticia') <span>{{$message}}
                    </span>@enderror
                    </div>
                    {{ csrf_field() }}
                </div>

