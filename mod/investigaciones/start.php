<?php

elgg_register_event_handler('init', 'system', 'investigaciones_init');

function investigaciones_init() {

    elgg_register_page_handler('investigaciones', 'investigaciones_handler');





    $plugin_path = elgg_get_plugins_path();

    $action_path = $plugin_path . "investigaciones/actions/nota";
    elgg_register_action('nota/agregar_nota', "$action_path/agregar_nota.php", "logged_in");
    elgg_register_action('nota/agregar_nota_tipo', "$action_path/agregar_nota.php", "logged_in");
    elgg_register_action('componente/agregar_componente', $plugin_path . "investigaciones/actions/componente/agregar_componente.php", "logged_in");
    elgg_register_action('componente/agregar_archivo', $plugin_path . "investigaciones/actions/componente/agregar_archivo.php", "logged_in");
    // Register Ajax view
    elgg_register_ajax_view("etapa/etapa1");
    elgg_register_ajax_view("calificacion/calificar_asesoria");
    elgg_register_ajax_view("etapa/etapa2");
    elgg_register_ajax_view("etapa/etapa3");
    elgg_register_ajax_view("etapa/etapa4");
    elgg_register_ajax_view("etapa/bitacoras_etapa1");
    elgg_register_ajax_view("etapa/bitacoras_etapa2");
    elgg_register_ajax_view("etapa/bitacoras_etapa3");
    elgg_register_ajax_view("etapa/bitacoras_etapa4");
    elgg_register_ajax_view("nota/agregar_nota");
    elgg_register_ajax_view("nota/guardar_nota");
    elgg_register_ajax_view("nota/agregar_nota_tipo");
    elgg_register_ajax_view("cuaderno_nota/ver_cuaderno");
    elgg_register_ajax_view("diario_campo/ver_diario");
    elgg_register_ajax_view("investigaciones/agregar_maestros");
    elgg_register_ajax_view("investigaciones/agregar_integrantes");
    elgg_register_ajax_view("investigaciones/ver_convocatorias_abiertas");
    elgg_register_ajax_view("investigaciones/definir_categoria");
    elgg_register_ajax_view("investigaciones/ver_ferias_abiertas");
    elgg_register_ajax_view("investigaciones/ver_calendario");
    elgg_register_ajax_view("investigaciones/ver_evento");
    elgg_register_ajax_view("investigaciones/diario/ver_diario");
    elgg_register_ajax_view("investigaciones/profile/informacion");
    elgg_register_ajax_view("componente/sistematizacion");
    elgg_register_ajax_view("componente/comunicacion");
    elgg_register_ajax_view("componente/formacion");
    elgg_register_ajax_view("componente/acompanamiento");
    elgg_register_ajax_view("componente/evaluacion");
    elgg_register_ajax_view("componente/herramientas");
    elgg_register_ajax_view("componente/innovacion");
    elgg_register_ajax_view("componente/agregar_componente_action");

    $url = "mod/investigaciones/vendors/pag_notas.js";
    elgg_register_js('pagination/notas', $url, 'head');

    $url = "mod/investigaciones/vendors/ajax_notas.js";
    elgg_register_js('ajax_notas', $url, 'head');

    //agregar librerias
    $lib = elgg_get_plugins_path() . 'investigaciones/lib/';
    elgg_register_library('investigaciones', $lib . 'lib_investigaciones.php');
    elgg_load_library('investigaciones');
}

function investigaciones_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'investigaciones/pages/investigaciones/';
    $base_path_diario = $plugin_path . 'investigaciones/pages/diario_campo/';
    switch ($page[0]) {

        case 'ver':
            set_input("id_investigacion", $page[1]);
            set_input("origen", $page[2]);
            set_input("id_origen", $page[3]);
            require $base_path . "ver_investigacion.php";
            break;

        case 'ver_diario':
            set_input("id", $page[1]);
            require $base_path_diario . "ver_diario.php";
            break;

        default:
            echo 'no funciona';
            break;
    }

    return true;
}
