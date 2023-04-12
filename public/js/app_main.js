Vue.component("politico", {
    template: "#perfil-politico",
    props: ["politico"]
});
const app = new Vue({
    el: "#fcd-rp-search",
    data: {
        buscar: "",
        perfiles: [],
        most_visited: [],
        current_page: 1,
        total_pages: "",
        total_records: 0,
        display_records: [],
        number_page_results: 12,
        number_results_pivot_pages: 8,
        filtrados: "",
        search_pages: [],
        slice_start: 0,
        slice_end: 0,
        partidos_politicos: [],
        cargos_politicos: [],
        checkedPartidos: [],
        checkedFuncionEstado: [],
        checkedInstitucion: [],
        checkedEstadoPolitico: [],
        checkedCargos: [],
        vermas_partidos: false,
        vermas_cargos_politicos: false,
        loading_search: true,
        cuadricula_search_view: true,
        lineal_search_view: false,
        search_order: "desc",
        funcion_legislativa: false,
        chipsdata: [],
        chip_changed: false,
        chip_add_changed: false,
        no_results: false
    },
    methods: {
        opensearchtabs: function(event) {
            var instance = M.Collapsible.getInstance($(".collapsible"));
            instance.open();
        },
        closesearchtabs: function(event) {
            var instance = M.Collapsible.getInstance($(".collapsible"));
            instance.close();
        },
        ver_perfil: function(perfil_id) {
            window.location.href = "/perfil/" + perfil_id;
        },
        make_pagination: function(number) {
            if (number) {
                this.current_page = number;
            }
            if (this.current_page != 1) {
                this.slice_start =
                    (this.current_page - 1) * this.number_page_results;
            } else {
                this.slice_start = 0;
            }
            this.slice_end = this.current_page * this.number_page_results;
            this.display_records = this.filtrados.slice(
                this.slice_start,
                this.slice_end
            );
            this.search_pages = [];
            if (this.current_page - 1 > 0) {
                this.search_pages.push({
                    text: '<i class="material-icons">chevron_left</i>',
                    action: this.current_page - 1,
                    list_class: {
                        active: false,
                        disabled: false,
                        "waves-effect": true
                    }
                });
            }
            this.search_pages.push({
                text: "Inicio",
                action: 1,
                list_class: {
                    active: false,
                    disabled: false,
                    "waves-effect": true
                }
            });
            // if(this.current_page-3 > 0) { this.search_pages.push({text: this.current_page-3, action: this.current_page-3, list_class: { active: false, disabled: false, 'waves-effect': true }}); }
            // if(this.current_page-2 > 0) { this.search_pages.push({text: this.current_page-2, action: this.current_page-2, list_class: { active: false, disabled: false, 'waves-effect': true }}); }
            // if(this.current_page-1 > 0) { this.search_pages.push({text: this.current_page-1, action: this.current_page-1, list_class: { active: false, disabled: false, 'waves-effect': true }});}
            var pivot_page = 1;
            var checking_pivot_page = true;
            while (checking_pivot_page) {
                if (
                    this.current_page <
                    pivot_page + this.number_results_pivot_pages
                ) {
                    checking_pivot_page = false;
                } else {
                    pivot_page = pivot_page + this.number_results_pivot_pages;
                }
            }
            for (var i = 0; i < this.number_results_pivot_pages; i++) {
                var active_page_status = false;
                if (pivot_page + i == this.current_page) {
                    active_page_status = true;
                }
                if (pivot_page + i <= this.total_pages) {
                    this.search_pages.push({
                        text: pivot_page + i,
                        action: pivot_page + i,
                        list_class: {
                            active: active_page_status,
                            disabled: false,
                            "waves-effect": true
                        }
                    });
                } else {
                    break;
                }
            }
            this.search_pages.push({
                text: "Final",
                action: this.total_pages,
                list_class: {
                    active: false,
                    disabled: false,
                    "waves-effect": true
                }
            });
            if (this.current_page + 1 < this.total_pages) {
                this.search_pages.push({
                    text: '<i class="material-icons">chevron_right</i>',
                    action: this.current_page + 1,
                    list_class: {
                        active: false,
                        disabled: false,
                        "waves-effect": true
                    }
                });
            }
            this.loading_search = false;
        },
        show_data: function(number) {
            this.loading_search = true;
            this.filtrados = this.perfiles;
            var instance = M.Chips.getInstance($(".chips-placeholder"));
            this.cargos_politicos = _.uniq(
                Array.from(
                    new Set(
                        this.filtrados.map(function(v) {
                            return v.nombre_categoria;
                        })
                    )
                )
            );
            if (!this.chip_changed) {
                this.chipsdata = instance.chipsData;
            } else {
                this.chip_changed = false;
                if (this.chip_add_changed) {
                    app.chip_add_changed = false;
                    this.buscar = "";
                } else {
                    this.buscar = instance.$input[0].value;
                }
            }
            //Aumentar el Cargo (ej. Contralor)
            if (this.buscar.trim() != "" && this.buscar.trim() != null) {
                var search_value = _.without(
                    this.$options.filters
                        .remove_accent_mark(this.buscar)
                        .toLowerCase()
                        .trim()
                        .split(" "),
                    "el",
                    "la",
                    "los",
                    "las",
                    "un",
                    "una",
                    "del",
                    "de"
                );
                this.filtrados = this.filtrados.filter(perfil => {
                    if (perfil) {
                        var search_params = [];
                        search_params.push(
                            this.$options.filters.remove_accent_mark(
                                perfil.name
                            )
                        );
                        search_params.push(
                            this.$options.filters.remove_accent_mark(
                                perfil.lastname
                            )
                        );
                        if (perfil.cargo != null) {
                            search_params.push(
                                this.$options.filters.remove_accent_mark(
                                    perfil.cargo
                                )
                            );
                        }
                        var pivot_search_index_count = 0;
                        var i;
                        for (i = 0; i < search_value.length; i++) {
                            if (
                                _.join(search_params, " ").indexOf(
                                    search_value[i]
                                ) !== -1
                            ) {
                                pivot_search_index_count++;
                            }
                        }
                        if (pivot_search_index_count == search_value.length)
                            return perfil;
                    }
                });
            }
            if (
                this.chipsdata &&
                this.chipsdata.length > 0 &&
                this.chipsdata[0]
            ) {
                this.filtrados = this.filtrados.filter(perfil => {
                    if (perfil) {
                        var search_params = [];
                        search_params.push(
                            this.$options.filters.remove_accent_mark(
                                perfil.name
                            )
                        );
                        search_params.push(
                            this.$options.filters.remove_accent_mark(
                                perfil.lastname
                            )
                        );
                        if (perfil.cargo != null) {
                            search_params.push(
                                this.$options.filters.remove_accent_mark(
                                    perfil.cargo
                                )
                            );
                        }
                        var pivot_search_index_count = 0;
                        var i;
                        for (i = 0; i < this.chipsdata.length; i++) {
                            //var search_value = this.$options.filters.remove_accent_mark(this.chipsdata[i].tag);
                            var chips_search_value = _.without(
                                this.$options.filters
                                    .remove_accent_mark(this.chipsdata[i].tag)
                                    .toLowerCase()
                                    .trim()
                                    .split(" "),
                                "el",
                                "la",
                                "los",
                                "las",
                                "un",
                                "una",
                                "del",
                                "de"
                            );
                            //if ((_.join(search_params,' ')).indexOf(search_value.toLowerCase().trim()) !== -1) { pivot_search_index_count++; };
                            var pivot_chips_search_index_count = 0;
                            var j;
                            for (j = 0; j < chips_search_value.length; j++) {
                                if (
                                    _.join(search_params, " ").indexOf(
                                        chips_search_value[j]
                                    ) !== -1
                                ) {
                                    pivot_chips_search_index_count++;
                                }
                            }
                            if (
                                pivot_chips_search_index_count ==
                                chips_search_value.length
                            ) {
                                pivot_search_index_count++;
                            }
                        }
                        if (pivot_search_index_count == this.chipsdata.length)
                            return perfil;
                    }
                });
            }
            //Filtros varios
            if (this.checkedCargos && this.checkedCargos.length > 0) {
                this.filtrados = this.filtrados.filter(perfil => {
                    if (this.checkedCargos == "Presidente") {
                        if (perfil) {
                            if (
                                $.inArray(
                                    perfil.nombre_categoria,
                                    this.checkedCargos
                                ) !== -1 ||
                                perfil.cargo ==
                                    "Presidente de la Asamblea Nacional"
                            )
                                return perfil;
                        }
                    } else {
                        if (perfil) {
                            if (
                                $.inArray(
                                    perfil.nombre_categoria,
                                    this.checkedCargos
                                ) !== -1
                            )
                                return perfil;
                        }
                    }
                });
            }
            //Filtros varios
            if (
                this.checkedFuncionEstado &&
                this.checkedFuncionEstado.length > 0
            ) {
                this.filtrados = this.filtrados.filter(perfil => {
                    if (perfil) {
                        if (
                            $.inArray(
                                perfil.funcion_estado_id,
                                this.checkedFuncionEstado
                            ) !== -1
                        )
                            return perfil;
                    }
                });
            }
            //Filtros varios
            if (this.checkedInstitucion && this.checkedInstitucion.length > 0) {
                this.filtrados = this.filtrados.filter(perfil => {
                    if (perfil) {
                        if (
                            $.inArray(
                                perfil.funcion_estado_id,
                                this.checkedInstitucion
                            ) !== -1
                        )
                            return perfil;
                    }
                });
            }
            //Filtros varios
            if (
                this.checkedEstadoPolitico &&
                this.checkedEstadoPolitico.length > 0
            ) {
                this.filtrados = this.filtrados.filter(perfil => {
                    var search_value = "";
                    if (perfil.estado_cargo == "Funcionario") search_value = 1;
                    else search_value = 2;
                    if (perfil) {
                        if (
                            this.checkedEstadoPolitico == 2 ||
                            this.checkedEstadoPolitico == 3
                        ) {
                            if (
                                /*$.inArray(search_value, this.checkedEstadoPolitico) !== -1 || */ $.inArray(
                                    perfil.es_candidato,
                                    this.checkedEstadoPolitico
                                ) !== -1
                            )
                                return perfil;
                        } else {
                            if (
                                $.inArray(
                                    search_value,
                                    this.checkedEstadoPolitico
                                ) !== -1
                            )
                                return perfil;
                        }
                    }
                });
            }
            //Filtros Checkbox
            if (this.funcion_legislativa) {
                this.partidos_politicos = _.uniq(
                    Array.from(
                        new Set(
                            this.filtrados.map(function(v) {
                                return v.partido;
                            })
                        )
                    )
                );
                if (this.checkedPartidos && this.checkedPartidos.length > 0) {
                    this.filtrados = this.filtrados.filter(perfil => {
                        if (perfil) {
                            if (
                                $.inArray(
                                    perfil.partido,
                                    this.checkedPartidos
                                ) !== -1
                            )
                                return perfil;
                        }
                    });
                }
            }
            //Ordenar con https://lodash.com orderBy
            //this.filtrados = _.orderBy(this.filtrados, ['name', 'lastname'], [this.search_order, this.search_order]);

            const unique = [
                ...new Map(this.filtrados.map(m => [m.id, m])).values()
            ];
            this.filtrados = unique;

            if (this.search_order == "cargo") {
                this.filtrados = _.orderBy(this.filtrados, ["orden"], ["asc"]);
            } else {
                //this.filtrados = _.orderBy(this.filtrados, [item => _.get(item, 'name').toLowerCase().trim(), item2 => _.get(item2, 'lastname').toLowerCase().trim()], [this.search_order, this.search_order]);
            }
            if (Object.keys(this.filtrados).length != 0) {
                this.total_records = Object.keys(this.filtrados).length;
                if (this.number_page_results == "todos") {
                    this.number_page_results = this.total_records + 1;
                }
                this.total_pages = Math.ceil(
                    (this.total_records + 1) / this.number_page_results
                );
                this.make_pagination(number);
                this.no_results = false;
            } else {
                this.total_records = 0;
                this.total_pages = 0;
                this.search_pages = [];
                this.display_records = [];
                this.loading_search = false;
                this.no_results = true;
            }
        },
        activate_option_legislativo: function(event) {
            if (event.target.checked) {
                this.funcion_legislativa = true;
                app.show_data();
            } else {
                this.funcion_legislativa = false;
                $(".partidos_checkbox").prop("checked", false);
                app.checkedPartidos = [];
                app.show_data();
            }
        }
    },
    filters: {
        corregir_json: function(value) {
            return JSON.stringify(JSON.parse(value), null, 2);
        },
        remove_accent_mark: function(s) {
            if (s.normalize != undefined) {
                s = s.normalize("NFKD");
            }
            return s
                .replace(/[\u0300-\u036F]/g, "")
                .toLowerCase()
                .trim();
        }
    },
    mounted() {
        //this.loading_search = true;
        //fetch('http://localhost:8000/api/persona-detalle')
        fetch("/api/persona-detalle")
            //fetch('http://192.168.100.29:8080/api/listadopoliticos')
            //fetch('http://192.168.100.27:8080/api/listadopoliticos')
            .then(response => response.json())
            .then(json => {
                this.perfiles = json;
                this.show_data();
            });
        fetch("/api/most-visited")
            .then(response => response.json())
            .then(json => {
                console.log("test:", json);
                this.most_visited = json;
                this.show_data();
            });
        //Init Materialize Elements
        //Tags search
        var self_vue = this;
        $(".chips-placeholder").chips({
            placeholder: "Buscar",
            secondaryPlaceholder: "+Etiqueta",
            onChipDelete: function() {
                app.chipsdata = this.chipsData;
                app.chip_changed = true;
                app.show_data();
            },
            onChipAdd: function() {
                app.chipsdata = this.chipsData;
                app.chip_changed = true;
                app.chip_add_changed = true;
                app.show_data();
            }
        });
        document
            .querySelector(".chips-placeholder input")
            .addEventListener("input", e => {
                app.buscar = e.target.value;
                app.show_data();
            });
    }
});
(function($) {
    $(function() {
        //Menu Búsqueda
        //$(".collapsible-header").parent().addClass("active");
        $(".collapsible").collapsible({
            accordion: false
        });
        $(".collapsible-header")
            .parent()
            .addClass("active");
        $(".collapsible.expandable").collapsible({
            accordion: true
        });
        $(".dropdown-trigger").dropdown({
            coverTrigger: false,
            hover: true,
            constrainWidth: false
        });
        $(".scrollspy").scrollSpy();
        $(".slider").slider();
        //$('.fixed-action-btn').floatingActionButton();
        //$('.search-filters-btn').floatingActionButton();
        $("select").formSelect();
        var instance = M.Collapsible.getInstance($(".collapsible"));
        //instance.open();
        // $('.sidenav-overlay').click( function () {
        //   $('#opciones-filtrado').css('transform', 'none');
        // });
        var ajustar_sidenav_ventana = function() {
            //var ancho_ventana = document.body.clientWidth;
            var ancho_ventana = $(window).width();
            if (ancho_ventana <= 992) {
                $("#opciones-filtrado")
                    .removeClass("sidenav")
                    .addClass("sidenav");
                $(".sidenav").sidenav();
            } else if (ancho_ventana > 992) {
                $("#opciones-filtrado").removeClass("sidenav");
                $(".sidenav-overlay").attr(
                    "style",
                    "display: none; opacity: 0;"
                );
                $("body").removeAttr("style");
                $("#opciones-filtrado").css("transform", "none");
            }
        };
        $(window).bind("resize", function() {
            ajustar_sidenav_ventana();
        });
        // $(window).resize(function(){
        //   ajustar_sidenav_ventana();
        // });
        ajustar_sidenav_ventana();
    });
})(jQuery);
