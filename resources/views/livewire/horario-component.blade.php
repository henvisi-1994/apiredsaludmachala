<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Horario</h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('livewire.horario.table')
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
@include("livewire.horario.$view")
@include('livewire.horario.edit')
