<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Centros Medico</h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('livewire.centro_medico.table')
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<!-- modal -->
@include("livewire.centro_medico.$view")
@include('livewire.centro_medico.edit')
@include('livewire.centro_medico.asignarEsp')
@include('livewire.centro_medico.editarAsigEsp')

