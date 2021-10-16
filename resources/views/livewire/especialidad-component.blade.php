<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Especialidades</h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('livewire.especialidad.table')
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
@include("livewire.especialidad.$view")
@include('livewire.especialidad.edit')
