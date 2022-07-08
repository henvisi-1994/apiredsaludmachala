let token = localStorage.getItem("token");
$.ajaxSetup({
    headers: {

        'Authorization': "Bearer " + token //the token is a variable which holds the token
    }
});
$(document).ready(function() {
    var datatableuser = $('#turnos').DataTable({
        "ajax": "api/obtener_horario",
        "columns": [{
                "data": "fecha"
            },
            {
                "data": "hora"
            },
            {
                "data": "nombre_medico"
            },
            {
                "data": "nombre_especialidad"
            },
            {
                "data": "nombre_centroMedico"
            },
            {
                "render": function(data, type, full, meta) {
                    if (full.estado == true) {
                        return '<div class="p-1 mb-1 bg-success text-white text-center">Activo</div>'
                    } else {
                        return ' <div class="p-1 mb-1 bg-danger text-white text-center">Inactivo</div>'
                    }
                }
            },
            {
                "render": function(data, type, full, meta) {
                    if (full.estado == true) {
                        return '<button class="btn btn-primary"><i class="far fa-edit"></i></button>'
                    }

                }
            },
            {
                "render": function(data, type, full, meta) {
                    if (full.estado == true) {
                        return '<button class="btn btn-success"  v-on:click.prevent="habilitar_horarios(horario.id_horario)"><i class="fas fa-toggle-on"></i></button>'
                    }
                }
            },
            {
                "render": function(data, type, full, meta) {
                    if (full.estado == true) {
                        return '<button class="btn btn-danger" v-on:click.prevent="deleteHorario(horario.id_horario)"><i class="fas fa-trash"></i></button>'
                    }

                }
            },

        ],
    });

});
