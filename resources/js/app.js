/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
document.write('<script src="vendor/jquery/jquery.min.js"></script>');
document.write(
    '<script src="vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>'
);
document.write(
    '<script src="vendor/adminlte/dist/js/adminlte.min.js"></script>'
);
document.write('<script src="vendor/toastr/js/toastr.js"></script>');

require("./bootstrap");
import JQuery from "jquery";
import { filter } from "lodash";
var $ = JQuery;

window.Vue = require("vue").default;
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: "#app",
    created: function() {
        this.getNoticias();
        this.getCentrosMedicos();
        this.getDetalleEspecialidades();
        this.getEspecialidades();
        this.getHoras();
        this.getHorarios();
        this.getCitas();
        this.getMedicos();
        this.getMedicosProd();
        this.getCalificaciones();
        this.getUsuarios();

    },
    data: {
        url: "http://apiredsaludmachala.net/",
        search: "",
        change_password: {
            password_old: "",
            password_new: "",
            password_confirm: ""
        },
        id_especialidad_m: 0,
        auxiliar_m: [],
        search_citas: "",
        search_noticias: "",
        search_especialidades: "",
        search_usuario: "",
        search_calificacion: "",
        search_medicos: "",
        search_medicos_prod: "",
        user: { email: "", password: "", clave_autorizacion: "" },
        id_especialidad: 0,
        nombre_centroMedico: "",
        id_centroMedico: 0,
        edit: false,
        noticias: [],
        centros_medicos: [],
        especialidades: [],
        detalle_especialidades: [],
        auxiliar: [],
        calificaciones: [],
        medicos: [],
        citas: [],
        medicos_prod: [],
        horas: [],
        horarios: [],
        links: [],
        links_user: [],
        usuarios: [],
        edit_centro_medico: false,
        edit_especialidad: false,
        edit_detalleCentroMedico: false,
        edit_hora: false,
        edit_horario: false,
        tipo_medico: "Medico Fijo",
        is_cargamasiva: false,
        noticia: {
            titulo_noticia: "",
            imagen_noticia: "",
            descripcion_noticia: "",
            hora_inicio_noticia: "",
            fecha_inicio_noticia: "",
            hora_fin_noticia: "",
            fecha_fin_noticia: ""
        },
        detalleCentroMedico: {
            id_detalleCentroMed: 0,
            id_centroMedico: 0,
            id_especialidad: 0
        },
        centro_medico: {
            nombre_centroMedico: "",
            direccion_centroMedico: "",
            telef_centroMedico: "",
            ubic_centroMedico: "",
            email: ""
        },
        especialidad: {
            nombre_especialidad: "",
            valor: 0
        },
        hora: {
            hora: ""
        },
        horario: {
            id_horario: 0,
            fecha: "",
            id_hora: 0,
            id_medico: 0
        },
        medico: {
            tipo_medico: "",
            id_detalleCentroMed: 0,
            nombre_medico: ""
        },
        medico_prod: {
            nomb_medico: "",
            id_especialidad: 0
        },
        turno_masivo: {
            id_medico: 0,
            csv_file: ""
        }
    },

    methods: {
        tabla() {
            this.$nextTick(() => {
                $('#turnos').DataTable();
            })
        },
        getNoticias() {
            let urlNoticias = "api/all";
            let token = localStorage.getItem("token");

            axios
                .get(urlNoticias, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.noticias = response.data;
                });
        },
        createNoticia: function() {
            let urlGuardarNoticia = "api/noticias";
            let image = new Image();
            let reader = new FileReader();
            let vm = this;
            reader.onload = event => {
                vm.image = event.target.result;
            };
            this.noticia.imagen_noticia = vm.image;
            this.noticia.fecha_inicio_noticia =
                this.noticia.fecha_inicio_noticia +
                " " +
                this.noticia.hora_inicio_noticia;
            this.noticia.fecha_fin_noticia =
                this.noticia.fecha_fin_noticia +
                " " +
                this.noticia.hora_fin_noticia;
            let token = localStorage.getItem("token");
            axios

                .post(urlGuardarNoticia, this.noticia, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getNoticias();
                    this.noticia = {
                        titulo_noticia: "",
                        imagen_noticia: "",
                        descripcion_noticia: "",
                        fecha_inicio_noticia: "",
                        fecha_fin_noticia: ""
                    };
                    this.errors = [];
                    $("#modal-noticia").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    toastr.success("Se añadido una nueva Noticia");
                    window.locationf = this.url + "noticias";
                })
                .catch(error => {
                    toastr.error("Por favor rellene los campos");
                    toastr.error(error.response.data.message);
                    this.errors = error.response.data;
                });
        },
        editNoticia: function(noticia) {
            this.edit = true;
            this.noticia.id_noticia = noticia.id_noticia;
            this.noticia.titulo_noticia = noticia.titulo_noticia;
            this.noticia.imagen_noticia = noticia.imagen_noticia;
            this.noticia.descripcion_noticia = noticia.descripcion_noticia;
            this.noticia.fecha_inicio_noticia = noticia.fecha_inicio_noticia.split(
                " "
            )[0];
            this.noticia.fecha_fin_noticia = noticia.fecha_fin_noticia.split(
                " "
            )[0];
            this.noticia.hora_inicio_noticia = noticia.fecha_inicio_noticia.split(
                " "
            )[1];
            this.noticia.hora_fin_noticia = noticia.fecha_fin_noticia.split(
                " "
            )[1];
            $("#modal-noticiaed").modal("show");
        },
        updateNoticia: function() {
            let url = "api/updatenoticia/" + this.noticia.id_noticia;
            let image = new Image();
            let reader = new FileReader();
            let vm = this;
            let token = localStorage.getItem("token");

            reader.onload = event => {
                vm.image = event.target.result;
            };
            this.noticia.imagen_noticia = vm.image;
            this.noticia.fecha_inicio_noticia =
                this.noticia.fecha_inicio_noticia +
                " " +
                this.noticia.hora_inicio_noticia;
            this.noticia.fecha_fin_noticia =
                this.noticia.fecha_fin_noticia +
                " " +
                this.noticia.hora_fin_noticia;
            axios
                .post(url, this.noticia, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getNoticias();
                    this.noticia = {
                        titulo_noticia: "",
                        imagen_noticia: "",
                        descripcion_noticia: "",
                        hora_inicio_noticia: "",
                        fecha_inicio_noticia: "",
                        hora_fin_noticia: "",
                        fecha_fin_noticia: ""
                    };
                    this.getNoticias();
                    $("#modal-noticiaed").modal("hide");
                    toastr.success("Noticia actualizada con éxito");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        deleteNoticia: function(id_noticia) {
            let url = "api/noticias/" + id_noticia;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getNoticias();
                    toastr.success("Noticia eliminada con éxito");
                });
        },
        createImage(file) {
            let image = new Image();
            let reader = new FileReader();
            let vm = this;
            reader.onload = event => {
                vm.image = event.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(event) {
            this.image = "";
        },
        getImagenNoticia(event) {
            //Asignamos la imagen a  nuestra data
            let files = event.target.files || event.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
        },
        buscar_noticias: function() {
            //element.name == this.search
            if (!!this.search_noticias) {
                return this.noticias.filter(item => {
                    return (
                            item.titulo_noticia +
                            item.descripcion_noticia +
                            item.fecha_inicio_noticia +
                            item.fecha_fin_noticia
                        )
                        .toLowerCase()
                        .includes(this.search_noticias.toLowerCase());
                });
            } else {
                return this.noticias;
            }
        },
        //Metodos de Calificacion
        //*********************************************** */
        //**************************************************** */
        getCalificaciones() {
            let urlcalificaciones = "api/calificacion";
            let token = localStorage.getItem("token");

            axios
                .get(urlcalificaciones, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.calificaciones = response.data;
                });
        },
        buscar_calificaciones: function() {
            //element.name == this.search
            if (!!this.search_calificacion) {
                return this.calificaciones.filter(item => {
                    return (
                            item.nombre_especialidad +
                            item.nombre_centroMedico +
                            item.nombre_medico +
                            item.fecha +
                            item.calificacion
                        )
                        .toLowerCase()
                        .includes(this.search_calificacion.toLowerCase());
                });
            } else {
                return this.calificaciones;
            }
        },
        //Metodos de Centros Medicos
        //*********************************************** */
        //**************************************************** */
        getCentrosMedicos() {
            let urlCentrosMedicos = "api/obtener_centros_medicos";
            let token = localStorage.getItem("token");

            axios
                .get(urlCentrosMedicos, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.centros_medicos = response.data;
                });
        },
        createCentroMedico: function() {
            let urlGuardarCentroMedico = "api/centros_medicos";
            let token = localStorage.getItem("token");
            axios

                .post(urlGuardarCentroMedico, this.centro_medico, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.detalleCentroMedico.id_centroMedico =
                        response.data.id_centroMedico;
                    this.nombre_centroMedico =
                        response.data.nombre_centroMedico;
                    this.obtener_detalleIdCentMed();
                    this.getCentrosMedicos();
                    this.centro_medico = {
                        nombre_centroMedico: "",
                        direccion_centroMedico: "",
                        telef_centroMedico: "",
                        ubic_centroMedico: "",
                        email: ""
                    };
                    this.errors = [];
                    $("#modal-centrosmedicos").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    toastr.success("Se añadido un nuevo Centro Medico");
                    window.locationf =
                        this.url + "centrosmedicos";
                    $("#modal-asignarEspecialidad").modal("show");
                })
                .catch(error => {
                    toastr.error("Por favor rellene los campos");
                    toastr.error(error.response.data.message);
                    this.errors = error.response.data;
                });
        },
        createDetalleCentromedico: function() {
            let urlGuardarCentroMedico = "api/detalle_centro_medico";
            let token = localStorage.getItem("token");
            if (!this.edit_detalleCentroMedico) {
                let aux;
                aux = this.auxiliar
                    .map(function(e) {
                        return e.id_especialidad;
                    })
                    .indexOf(this.detalleCentroMedico.id_especialidad);
                if (aux == -1) {
                    axios

                        .post(
                            urlGuardarCentroMedico,
                            this.detalleCentroMedico, {
                                headers: {
                                    Authorization: "Bearer " + token //the token is a variable which holds the token
                                }
                            }
                        )
                        .then(response => {
                            this.getCentrosMedicos();
                            this.getDetalleEspecialidades();
                            this.obtener_detalleIdCentMed();
                            this.detalleCentroMedico.id_especialidad = 0;
                            this.errors = [];
                            toastr.success(
                                "Se ha asignado una nueva Especialidad a Centro Medico"
                            );
                        })
                        .catch(error => {
                            this.errors = error.response.data;
                        });
                } else {
                    toastr.error(
                        "La especialidad ya existe en el Centro Medico... Asigne Otra"
                    );
                }
            } else {
                this.updateDetalleCentroMedico();
            }
        },
        updateDetalleCentroMedico: function() {
            let url =
                "api/update_detalle_centro_medicos/" +
                this.detalleCentroMedico.id_detalleCentroMed;

            let token = localStorage.getItem("token");
            axios
                .post(url, this.detalleCentroMedico, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getDetalleEspecialidades();
                    this.obtener_detalleIdCentMed();
                    this.edit_detalleCentroMedico = false;
                    this.detalleCentroMedico.id_especialidad = 0;
                    toastr.success("Especialidad actualizada con éxito");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        editCentroMedico: function(centroMedico) {
            this.edit_centro_medico = true;
            this.centro_medico.id_centroMedico = centroMedico.id_centroMedico;
            this.centro_medico.nombre_centroMedico =
                centroMedico.nombre_centroMedico;
            this.centro_medico.direccion_centroMedico =
                centroMedico.direccion_centroMedico;
            this.centro_medico.telef_centroMedico =
                centroMedico.telef_centroMedico;
            this.centro_medico.ubic_centroMedico =
                centroMedico.ubic_centroMedico;
            this.centro_medico.email = centroMedico.email;

            $("#modal-centromedicoed").modal("show");
        },
        updateCentroMedico: function() {
            let url =
                "api/updatecentrosmedicos/" +
                this.centro_medico.id_centroMedico;

            let token = localStorage.getItem("token");
            axios
                .post(url, this.centro_medico, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.detalleCentroMedico.id_centroMedico = this.centro_medico.id_centroMedico;
                    this.nombre_centroMedico = this.centro_medico.nombre_centroMedico;
                    this.obtener_detalleIdCentMed();
                    this.getCentrosMedicos();
                    this.centro_medico = {
                        nombre_centroMedico: "",
                        direccion_centroMedico: "",
                        telef_centroMedico: "",
                        ubic_centroMedico: "",
                        email: ""
                    };
                    $("#modal-centromedicoed").modal("hide");
                    $("#modal-editAsigcentromedico").modal("show");
                    toastr.success("Centro Medico actualizado con éxito");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        deleteCentroMedico: function(id_centroMedico) {
            let url = "api/centros_medicos/" + id_centroMedico;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getCentrosMedicos();
                    toastr.success("Centro Medico eliminado con éxito");
                })
                .catch(error => {
                    toastr.error("Elimine Especialidades Agregadas para eliminar Centro Medico");
                    this.errors = error.response.data;
                });
        },
        //fin de metodos de centros medicos

        //Metodos de Especialidades
        //*********************************************** */
        //**************************************************** */
        getDetalleEspecialidades() {
            let urlDetalleCentroMedico = "api/obtener_detalle_centro_medicos";
            let token = localStorage.getItem("token");

            axios
                .get(urlDetalleCentroMedico, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.detalle_especialidades = response.data;
                });
        },
        getEspecialidades() {
            let urlEspecialidades = "api/obtener_especialidades";
            let token = localStorage.getItem("token");

            axios
                .get(urlEspecialidades, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.especialidades = response.data;
                });
        },
        createEspecialidad: function() {
            let urlGuardarEspecialidad = "api/especialidades";
            let token = localStorage.getItem("token");
            axios

                .post(urlGuardarEspecialidad, this.especialidad, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getEspecialidades();
                    this.especialidad = {
                        nombre_especialidad: "",
                        valor: 0
                    };
                    this.errors = [];
                    $("#modal-especialidades").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    toastr.success("Se ha añadido una Nueva Especialidad");
                    window.locationf =
                        this.url + "especialidades";
                })
                .catch(error => {
                    toastr.error("Por favor rellene los campos");
                    toastr.error(error.response.data.message);
                    this.errors = error.response.data;
                });
        },
        editEspecialidad: function(especialidad) {
            this.edit_especialidad = true;
            this.especialidad.id_especialidad = especialidad.id_especialidad;
            this.especialidad.nombre_especialidad =
                especialidad.nombre_especialidad;
            this.especialidad.valor = especialidad.valor;

            $("#modal-especialidaded").modal("show");
        },
        updateEspecialidad: function() {
            let url =
                "api/updateespecialidades/" + this.especialidad.id_especialidad;

            let token = localStorage.getItem("token");
            axios
                .post(url, this.especialidad, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getEspecialidades();
                    this.especialidad = {
                        nombre_especialidad: "",
                        valor: 0
                    };
                    $("#modal-especialidaded").modal("hide");
                    toastr.success("Especialidad actualizada con éxito");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        deleteEspecialidad: function(id_especialidad) {
            let url = "api/especialidades/" + id_especialidad;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getEspecialidades();
                    toastr.success("Especialidad eliminada con éxito");
                });
        },
        obtener_especialidades(event) {
            let id_centroMedico = event.target.value;
            this.auxiliar = this.detalle_especialidades.filter(
                centroMedico => centroMedico.id_centroMedico == id_centroMedico
            );
        },
        obtener_medico(event) {
            let id_especialidad = event.target.value;
            this.auxiliar_m.length = 0;
            this.auxiliar_m = this.medicos.filter(
                medico => medico.id_centroMedico == this.id_centroMedico && medico.id_especialidad == id_especialidad
            );
        },
        buscar_especialidad: function() {
            //element.name == this.search
            if (!!this.search_especialidades) {
                return this.especialidades.filter(item => {
                    return item.nombre_especialidad
                        .toLowerCase()
                        .includes(this.search_especialidades.toLowerCase());
                });
            } else {
                return this.especialidades;
            }
        },
        obtener_detalleIdCentMed() {
            let id_centroMedico = this.detalleCentroMedico.id_centroMedico;
            /*console.log(id_centroMedico);
           this.auxiliar = this.detalle_especialidades.filter(centroMedico => centroMedico.id_centroMedico==id_centroMedico);

           console.log(this.auxiliar);*/
            let urlDetalleCentroMedico = "api/obtener_detalle_centro_medicos";
            let token = localStorage.getItem("token");

            axios
                .get(urlDetalleCentroMedico, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.auxiliar = response.data.filter(
                        centroMedico =>
                        centroMedico.id_centroMedico == id_centroMedico
                    );
                });
        },
        editAsigEspec: function(detalleCentroMedico) {
            this.edit_detalleCentroMedico = true;
            this.detalleCentroMedico.id_especialidad =
                detalleCentroMedico.id_especialidad;
            this.detalleCentroMedico.id_detalleCentroMed =
                detalleCentroMedico.id_detalleCentroMed;
        },
        deleteAsigEspec: function(id_detalleCentroMed) {
            let url = "api/detalle_centro_medico/" + id_detalleCentroMed;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getDetalleEspecialidades();
                    this.obtener_detalleIdCentMed();
                    toastr.success("Especialidad eliminada con éxito");
                })
                .catch(error => {
                    toastr.error("Existen Citas Asignadas, no puede eliminar Especialidad");
                    this.errors = error.response.data;
                });
        },
        //fin de metodos de especialidades

        //Metodos de Medicos
        //*********************************************** */
        //**************************************************** */
        getMedicos() {
            let urlMedicos = "api/obtener_medicos";
            let token = localStorage.getItem("token");

            axios
                .get(urlMedicos, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.medicos = response.data;
                });
        },
        createMedicos: function() {
            let urlGuardarMedicos = "api/medicos";
            let token = localStorage.getItem("token");
            if (this.tipo_medico == "Medico Fijo") {
                axios

                    .post(urlGuardarMedicos, this.medico, {
                        headers: {
                            Authorization: "Bearer " + token //the token is a variable which holds the token
                        }
                    })
                    .then(response => {
                        this.getMedicos();
                        this.medico = {
                            tipo_medico: "",
                            id_detalleCentroMed: 0,
                            nombre_medico: ""
                        };
                        this.errors = [];
                        $("#modal-medicos").modal("hide");
                        if ($(".modal-backdrop").is(":visible")) {
                            $("body").removeClass("modal-open");
                            $(".modal-backdrop").remove();
                        }

                        toastr.success("Se añadido un Nuevo Medico");
                        window.locationf =
                            this.url + "medicos";
                    })
                    .catch(error => {
                        toastr.error("Por favor rellene los campos");
                        toastr.error(error.response.data.message);
                        this.errors = error.response.data;
                    });
            } else {
                this.createMedicosProd();
            }
        },
        editMedico: function(medico) {
            this.edit_medico = true;
            this.tipo_medico = "Medico Fijo";
            this.medico.id_medico = medico.id_medico;
            this.medico.tipo_medico = medico.tipo_medico;
            this.medico.id_detalleCentroMed = medico.id_detalleCentroMed;
            this.medico.nombre_medico = medico.nombre_medico;

            $("#modal-medicoed").modal("show");
        },
        updateMedico: function() {
            let url = "api/updatemedicos/" + this.medico.id_medico;
            let token = localStorage.getItem("token");
            if (this.tipo_medico == "Medico Fijo") {
                axios
                    .post(url, this.medico, {
                        headers: {
                            Authorization: "Bearer " + token //the token is a variable which holds the token
                        }
                    })
                    .then(response => {
                        this.getMedicos();
                        this.medico = {
                            tipo_medico: "",
                            id_detalleCentroMed: 0,
                            nombre_medico: ""
                        };
                        $("#modal-medicoed").modal("hide");
                        toastr.success("Medico actualizado con éxito");
                    })
                    .catch(error => {
                        this.errors = error.response.data;
                    });
            } else {
                this.updateMedicoProd();
            }
        },
        deleteMedico: function(id_medico) {
            let url = "api/medicos/" + id_medico;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getMedicos();
                    toastr.success("Medico eliminado con éxito");
                });
        },
        obtener_tipo_medico(event) {
            this.tipo_medico = event.target.value;
        },
        buscar_medico: function() {
            //element.name == this.search
            if (!!this.search_medicos) {
                return this.medicos.filter(item => {
                    return (
                            item.nombre_medico +
                            item.nombre_centroMedico +
                            item.nombre_especialidad
                        )
                        .toLowerCase()
                        .includes(this.search_medicos.toLowerCase());
                });
            } else {
                return this.medicos;
            }
        },
        //fin de metodos de Medico

        //Metodos de Medicos de Produccion
        //*********************************************** */
        //**************************************************** */
        getMedicosProd() {
            let urlMedicosProd = "api/obtener_medicos_prod";
            let token = localStorage.getItem("token");

            axios
                .get(urlMedicosProd, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.medicos_prod = response.data;
                });
        },
        createMedicosProd: function() {
            let urlGuardarMedicosProd = "api/medicos_produccion";
            this.medico_prod.nomb_medico = this.medico.nombre_medico;
            let token = localStorage.getItem("token");
            axios

                .post(urlGuardarMedicosProd, this.medico_prod, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getMedicosProd();
                    this.medico_prod = {
                        nomb_medico: "",
                        id_especialidad: 0
                    };
                    this.errors = [];
                    $("#modal-medicos").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    toastr.success("Se añadido un Nuevo Medico de Produccion");
                    window.locationf = this.url + "medicos";
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        editMedicoProd: function(medicoProd) {
            this.edit_medico = true;
            this.tipo_medico = "";
            this.medico_prod.id_medico_prod = medicoProd.id_medico_prod;
            this.medico.nombre_medico = medicoProd.nombre_medico;
            this.medico_prod.id_especialidad = medicoProd.id_especialidad;
            this.medico_prod.nomb_medico = medicoProd.nombre_medico;

            $("#modal-medicoed").modal("show");
        },
        updateMedicoProd: function() {
            let url =
                "api/updatemedicos_prod/" + this.medico_prod.id_medico_prod;
            this.medico_prod.nomb_medico = this.medico.nombre_medico;
            let token = localStorage.getItem("token");
            axios
                .post(url, this.medico_prod, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getMedicosProd();
                    this.medico = {
                        nomb_medico: "",
                        id_especialidad: 0
                    };
                    $("#modal-medicoed").modal("hide");
                    toastr.success(
                        "Medico de Produccion actualizado con éxito"
                    );
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        deleteMedicoProd: function(id_medico_prod) {
            let url = "api/medicos_produccion/" + id_medico_prod;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getMedicosProd();
                    toastr.success("Medico de Produccion eliminado con éxito");
                });
        },
        buscar_medico_prod: function() {
            //element.name == this.search
            if (!!this.search_medicos_prod) {
                return this.medicos_prod.filter(item => {
                    return (item.nombre_medico + item.nombre_especialidad)
                        .toLowerCase()
                        .includes(this.search_medicos_prod.toLowerCase());
                });
            } else {
                return this.medicos_prod;
            }
        },
        //fin de metodos de Medico de Produccion

        //Metodos de Horas
        //*********************************************** */
        //**************************************************** */
        getHoras() {
            let urlHoras = "api/obtener_horas";
            let token = localStorage.getItem("token");

            axios
                .get(urlHoras, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.horas = response.data;
                });
        },
        createHora: function() {
            let urlGuardarHora = "api/horas";
            let token = localStorage.getItem("token");
            axios

                .post(urlGuardarHora, this.hora, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getHoras();
                    this.hora = {
                        hora: ""
                    };
                    this.errors = [];
                    $("#modal-horas").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    toastr.success("Se añadido una Hora");
                    window.locationf = this.url + "horas";
                })
                .catch(error => {
                    toastr.error("Por favor rellene los campos");
                    toastr.error(error.response.data.message);
                    this.errors = error.response.data;
                });
        },
        editHora: function(hora) {
            this.edit_hora = true;
            this.hora.id_hora = hora.id_hora;
            this.hora.hora = hora.hora;

            $("#modal-horaed").modal("show");
        },
        updateHora: function() {
            let url = "api/updatehoras/" + this.hora.id_hora;

            let token = localStorage.getItem("token");
            axios
                .post(url, this.hora, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getHoras();
                    this.hora = {
                        hora: ""
                    };
                    $("#modal-horaed").modal("hide");
                    toastr.success("Hora actualizada con éxito");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        deleteHora: function(id_hora) {
            let url = "api/horas/" + id_hora;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getHoras();
                    toastr.success("Hora eliminada con éxito");
                });
        },
        //fin de metodos de Horas
        //Metodos de Horas
        //*********************************************** */
        //**************************************************** */
        getCitas() {
            let urlCitas = "api/obtener_citas";
            let token = localStorage.getItem("token");

            axios
                .get(urlCitas, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.citas = response.data;
                });
        },
        buscar_citas: function() {
            //element.name == this.search
            if (!!this.search_citas) {
                return this.citas.filter(item => {
                    return (
                            item.nombre_especialidad +
                            item.nombre_centroMedico +
                            item.nombre_medico +
                            item.fecha
                        )
                        .toLowerCase()
                        .includes(this.search_citas.toLowerCase());
                });
            } else {
                return this.citas;
            }
        },
        //Fin Metodo de Citas
        //Metodos de Horarios
        //*********************************************** */
        //**************************************************** */
        getHorarios() {
            let urlHorarios = "api/obtener_horario";
            let token = localStorage.getItem("token");

            axios
                .get(urlHorarios, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.links = response.data.links;
                    this.horarios = response.data.data;
                });
        },
        paginar_horario(url) {
            let token = localStorage.getItem("token");
            axios
                .get(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.links = response.data.links;
                    this.horarios = response.data.data;
                });
        },
        paginar_usuario(url) {
            let token = localStorage.getItem("token");
            axios
                .get(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.links_user = response.data.links;
                    this.usuarios = response.data.data;
                });
        },

        createHorario: function() {
            let urlGuardarHorario = "api/horarios";
            let token = localStorage.getItem("token");
            axios

                .post(urlGuardarHorario, this.horario, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getHorarios();
                    this.horario = {
                        fecha: "",
                        id_hora: 0,
                        id_medico: 0
                    };
                    this.errors = [];
                    $("#modal-horarios").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    toastr.success("Se ha añadido un Turno");
                    this.limpiar_turno();
                })
                .catch(error => {
                    toastr.error("Por favor rellene los campos");
                    toastr.error(error.response.data.message);
                    this.errors = error.response.data;
                });
        },
        editHorario: function(horario) {
            this.edit_horario = true;
            this.horario.id_horario = horario.id_horario;
            this.horario.fecha = horario.fecha;
            this.horario.id_hora = horario.id_hora;
            this.horario.id_medico = horario.id_medico;

            $("#modal-horarioed").modal("show");
        },
        updateHorario: function() {
            let url = "api/updatehorario/" + this.horario.id_horario;

            let token = localStorage.getItem("token");
            axios
                .post(url, this.horario, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getHorarios();
                    this.horario = {
                        fecha: "",
                        id_hora: 0,
                        id_medico: 0
                    };
                    $("#modal-horarioed").modal("hide");
                    toastr.success("Turno actualizado con éxito");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        deleteHorario: function(id_horario) {
            let url = "api/horarios/" + id_horario;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getHorarios();
                    toastr.success("Turno eliminado con éxito");
                });
        },
        buscar: function() {
            let token = localStorage.getItem("token");
            if (this.search.length != 0) {
                let urlHorarios = "api/buscar_horario/" + this.search;
                axios
                    .get(urlHorarios, {
                        headers: {
                            Authorization: "Bearer " + token //the token is a variable which holds the token
                        }
                    })
                    .then(response => {
                        this.links = response.data.links;
                        this.horarios = response.data.data;
                    });
            } else {
                this.getHorarios();
            }

        },

        habilitar_horarios(id) {
            let urlHabilitarHorarios = "api/habilitar_horarios/" + id;
            let token = localStorage.getItem("token");

            axios
                .get(urlHabilitarHorarios, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    toastr.success("Se ha habilitado la Cita");
                    this.getHorarios();
                });
        },

        //fin de metodos de Horario
        logout() {
            axios
                .post("/logout")
                .then(response => {
                    //this.$router.Push("/login")
                    window.location.replace("/login");
                })
                .catch(error => {
                    location.reload();
                });
        },
        autenticacion() {
            axios
                .post("/login", this.user)
                .then(response => {
                    window.location.href = this.url + "home";
                })
                .catch(response => {
                    // List errors on response...
                });
        },
        login: function() {
            let urlGuardarlogin = "api/logueo";
            if (this.user.clave_autorizacion == "RFBM8z3q") {
                axios
                    .post(urlGuardarlogin, this.user)

                .then(response => {
                        this.autenticacion();
                        this.user = {
                            email: "",
                            password: "",
                            clave_autorizacion: ""
                        };
                        localStorage.setItem("token", response.data.access_token);
                        localStorage.setItem("id_user", response.data.id);

                        this.errors = [];
                    })
                    .catch(error => {
                        toastr.error(error.response.data.messaje);
                        this.errors = error.response.data;
                    });
            } else {
                toastr.error("Por favor Ingrese Correctamente la Clave de Autorizacion")
            }

        },
        cambiarPassword: function() {
            let id_user = localStorage.getItem("id_user");
            let url = "api/cambiar_contrasena/" + id_user;
            let token = localStorage.getItem("token");
            if (
                this.change_password.password_new ==
                this.change_password.password_confirm
            ) {
                axios
                    .post(url, this.change_password, {
                        headers: {
                            Authorization: "Bearer " + token //the token is a variable which holds the token
                        }
                    })
                    .then(response => {
                        this.change_password = {
                            password_old: "",
                            password_new: "",
                            password_confirm: ""
                        };
                        toastr.success(
                            "Su contraseña ha sido cambiada exitosamente"
                        );
                    })
                    .catch(error => {
                        toastr.error(error.response.data.messaje);
                        this.errors = error.response.data;
                    });
            } else {

                toastr.error("Su contraseña no coincide, Revisar");
            }
        },
        existe_cita_horario: function(id) {
            const resultado = this.citas.find(cita => cita.id_horario === id);
            const horario = this.horarios.find(horario => horario.id_horario === id);
            if (resultado !== undefined) {
                return false;
            } else if (horario.estado == false) {
                return true;

            }
        },
        limpiar_turno: function() {
            this.horario.fecha = "";
            this.horario.id_hora = 0;
            this.id_centroMedico = 0;
            this.id_especialidad_m = 0;
            this.horario.id_medico = 0;
        },
        getArchivoCM: function(event) {
            if (event.target.files && event.target.files.length > 0) {
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function load() {
                    //this.image = reader.result;
                    this.obtener_archivo(reader.result, this.horario.id_medico);
                }.bind(this);
                this.file = file;
            }

        },
        obtener_archivo: function(file, id_medico) {
            let token = localStorage.getItem("token");
            this.turno_masivo.csv_file = file;
            this.turno_masivo.id_medico = id_medico;
            axios

                .post('/api/carga_masiva', this.turno_masivo, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    toastr.success(response.data.mensaje);
                    $("#modal-horarios").modal("hide");
                    this.is_cargamasiva = false;
                    this.horario = {
                        fecha: "",
                        id_hora: 0,
                        id_medico: 0

                    };
                    this.id_centroMedico = 0;
                    this.id_especialidad_m = 0;

                    this.getHorarios();
                })
                .catch(error => {
                    toastr.error(error.response.data.message);
                    this.errors = error.response.data;
                });
        },
        carga_masiva: function() {
            this.is_cargamasiva = true;
            $("#modal-horarios").modal("show");

        },
        abrir_nuevo: function() {
            this.is_cargamasiva = false;
            $("#modal-horarios").modal("show");
        },
        //Metodos de Usuarios
        //*********************************************** */
        //**************************************************** */
        getUsuarios() {
            let urlUsuarios = "api/obtener_usuario";
            let token = localStorage.getItem("token");

            axios
                .get(urlUsuarios, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.usuarios = response.data.data;
                    this.links_user = response.data.links;
                });
        },
        buscar_usuario: function() {
            //element.name == this.search
            if (!!this.search_usuario) {
                let urlUsuarios = "api/buscar_usuario/" + this.search_usuario;
                let token = localStorage.getItem("token");

                axios
                    .get(urlUsuarios, {
                        headers: {
                            Authorization: "Bearer " + token //the token is a variable which holds the token
                        }
                    })
                    .then(response => {
                        this.usuarios = response.data.data;
                        this.links_user = response.data.links;
                    });
            } else {
                this.getUsuarios();
            }
        },
        deleteUsuario: function(id) {
            let url = "api/usuarios/" + id;
            let token = localStorage.getItem("token");

            axios
                .delete(url, {
                    headers: {
                        Authorization: "Bearer " + token //the token is a variable which holds the token
                    }
                })
                .then(response => {
                    this.getUsuarios();
                    toastr.success("Usuario eliminado con éxito");
                })
                .catch(error => {
                    toastr.error(error.response.data.mensaje);
                    this.errors = error.response.data;
                });
        },

    }
});