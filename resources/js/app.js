/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

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
    },
    data: {
        edit:false,
        noticias: [],
        noticia: {
            'titulo_noticia': '',
            'imagen_noticia': '',
            'descripcion_noticia': '',
            'fecha_inicio_noticia': '',
            'fecha_fin_noticia': ''
        },
        fillNoticia: {
            'titulo_noticia': '',
            'imagen_noticia': '',
            'descripcion_noticia': '',
            'fecha_inicio_noticia': '',
            'fecha_fin_noticia': ''
        },
    },
    methods: {
        getNoticias() {
            let urlNoticias = "api/noticias";
            axios.get(urlNoticias).then(response => {
                this.noticias = response.data;
            });
        },
        createNoticia: function() {
            let urlGuardarNoticia = "api/noticias";
            axios
                .post(urlGuardarNoticia, this.noticia)
                .then(response => {
                    this.getNoticias();
                    noticia = {
                        titulo_noticia: "",
                        imagen_noticia: "",
                        descripcion_noticia: "",
                        fecha_inicio_noticia: "",
                        fecha_fin_noticia: ""
                    };
                    this.errors = [];
                    $("#modal-noticia").modal("hide");
                    toastr.success("Se añadido una nueva Noticia");
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        editNoticia: function(noticia) {
            this.edit=true;
            this.fillNoticia.titulo_noticia = noticia.titulo_noticia;
            this.fillNoticia.imagen_noticia = noticia.imagen_noticia;
            this.fillNoticia.descripcion_noticia = noticia.descripcion_noticia;
            this.fillNoticia.fecha_inicio_noticia = noticia.fecha_inicio_noticia;
            this.fillNoticia.fecha_fin_noticia = noticia.fecha_fin_noticia;
            $('#modal-noticia').modal('show');
        },
        updateNoticia: function(id) {
            let url = "api/noticias" + id;
            axios.post(url, this.fillNoticia).then(response => {
                this.getNoticias();
                this.fillNoticia = {
                    'titulo_noticia': '',
                    'imagen_noticia': '',
                    'descripcion_noticia': '',
                    'fecha_inicio_noticia': '',
                    'fecha_fin_noticia': ''
                };
                this.errors = [];
                $('#modal-noticia').modal('hide');
                toastr.success('Noticia actualizada con éxito');
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
    }
});
