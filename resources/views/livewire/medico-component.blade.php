<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Medicos</h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('livewire.medico.table')
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
@include("livewire.medico.$view")
@include('livewire.medico.edit')
