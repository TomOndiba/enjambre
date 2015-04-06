<?php

elgg_register_event_handler('init', 'system', 'asesores_init');

function asesores_init() {
    //Registro de Acciones
    $action_path = elgg_get_plugins_path() . "asesores/actions/asesores";
    elgg_register_action('asesores/desasociar_linea', "$action_path/desasociar_linea.php", "logged_in");
    elgg_register_action('asesores/asociar_linea', "$action_path/asociar_linea.php", "logged_in");
    elgg_register_action('asesores/aceptar_asesor', "$action_path/aceptar_asesor.php", "logged_in");
    elgg_register_action('asesores/rechazar_asesor_banco', "$action_path/rechazar_asesor_banco.php", "logged_in");
    elgg_register_action('asesores/convocar', "$action_path/convocar.php", "logged_in");
    elgg_register_action('asesores/convocar_asesores', "$action_path/convocar_asesores.php", "logged_in");
    elgg_register_action('asesores/inscripcion_convocatoria', "$action_path/inscripcion_convocatoria.php", "logged_in");
    elgg_register_action('asesores/inscripcion', "$action_path/inscribir_asesor.php", "logged_in");
    elgg_register_action('asesorias/registrar', elgg_get_plugins_path() . "asesores/actions/asesorias/registrar.php", "logged_in");
    elgg_register_action('asesorias/editar', elgg_get_plugins_path() . "asesores/actions/asesorias/editar.php", "logged_in");
    elgg_register_action('asesorias/eliminar', elgg_get_plugins_path() . "asesores/actions/asesorias/eliminar.php", "logged_in");
    elgg_register_action('asesorias/evidencias', elgg_get_plugins_path() . "asesores/actions/asesorias/evidencias.php", "logged_in");
    elgg_register_action('asesorias/resumen', elgg_get_plugins_path() . "asesores/actions/asesorias/resumen.php", "logged_in");
    elgg_register_action('asesorias_red/crear_dia_asesoria', elgg_get_plugins_path() . "asesores/actions/asesorias/crear_asesoria_red.php");


    //Registro de Handler
    elgg_register_page_handler('asesores', 'asesores_handler');

    //Registro de Libreria de asesores
    $lib = elgg_get_plugins_path() . 'asesores/lib/lib_asesores.php';
    elgg_register_library("asesores", $lib);
    elgg_load_library('asesores');

    //Registro archivos ajax
    $url = "mod/asesores/vendors/pagination_ajax.js";
    elgg_register_js('pagination/asesores', $url, 'head');

    $url = "mod/asesores/vendors/pagination_ajax_preinscritos.js";
    elgg_register_js('pagination/asesores_preinscritos', $url, 'head');

    $url = "mod/asesores/vendors/pagination_investigaciones.js";
    elgg_register_js('pagination/investigaciones', $url, 'head');

    $url = "mod/asesores/vendors/pag_investigaciones_conv_asignadas.js";
    elgg_register_js('pag/investig_conv', $url, 'head');

    $url = "mod/asesores/vendors/convocatorias_asesor.js";
    elgg_register_js('pag/conv_asesor', $url, 'head');



//
//    $url = "mod/evaluadores/vendors/pag_investigaciones_asignadas.js";
//    elgg_register_js('pag_investigaciones_asignadas', $url, 'head');

    $url = "mod/asesores/vendors/hoja-vida_asesor.js";
    elgg_register_js('hoja_de_vida', $url, 'head');



    //Registro de vistas en ajax
    elgg_register_ajax_view('asesores/ver_asesores_banco');
    elgg_register_ajax_view('asesores/ver_asesores_preinscritos');
    elgg_register_ajax_view('asesores/inscribir_asesor');
    elgg_register_ajax_view('asesores/hoja_de_vida/estudiosterminados');
    elgg_register_ajax_view('asesores/hoja_de_vida/cursosterminados');
    elgg_register_ajax_view('asesores/hoja_de_vida/guardar_estudios');
    elgg_register_ajax_view('asesores/hoja_de_vida/guardar_cursos');
    elgg_register_ajax_view('asesores/hoja_de_vida/experiencia');
    elgg_register_ajax_view('asesores/hoja_de_vida/guardar_experiencia');
    elgg_register_ajax_view('asesores/hoja_de_vida/experienciadocente');
    elgg_register_ajax_view('asesores/hoja_de_vida/guardar_experiencia_docente');
    elgg_register_ajax_view('asesores/hoja_de_vida/investigacion');
    elgg_register_ajax_view('asesores/hoja_de_vida/guardar_investigacion');
    elgg_register_ajax_view('asesores/hoja_de_vida/ponencias');
    elgg_register_ajax_view('asesores/hoja_de_vida/guardar_ponencias');
    elgg_register_ajax_view('asesorias/cronograma');
    elgg_register_ajax_view('asesores/investigaciones_asignadas');
    elgg_register_ajax_view('asesores/listar_convocatorias');
    elgg_register_ajax_view('asesorias/registrar_actividad');
    elgg_register_ajax_view('asesorias/editar_actividad');
    elgg_register_ajax_view('asesorias/agregar_webinar');
    elgg_register_ajax_view('asesorias/ver_webinar');
    elgg_register_ajax_view('asesorias/crear_asesoria_red');
    elgg_register_ajax_view('asesorias/ver_historial');
}

function asesores_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'asesores/pages/asesores';

    if (count($page) == 0) {
        $page[0] = 'asesores_aceptados';
    }

    switch ($page[0]) {

        case 'asesores_preinscritos':
            require "$base_path/ver_asesores_preinscritos.php";
            break;
        case 'asesores_aceptados':
            require "$base_path/ver_asesores_banco.php";
            break;
        case 'convocar':
            set_input("guid_convocatoria", $page[1]);
            require "$base_path/convocar.php";
            break;
        case 'hojadevida':
            require "$base_path/hoja_de_vida/ver_hoja_de_vida.php";
            break;
        case 'ver_hojadevida':
            set_input("id_user", $page[1]);
            require "$base_path/hoja_de_vida/vista_hoja_de_vida.php";
            break;
        case 'asesorias':
            asesoria_handler($page);
            break;
        case 'misLineas':
            require "$base_path/ver_mis_lineas.php";
            break;
        case 'cronograma':
            if ($page[1]) {
                set_input('asesoria',$page[1]);
                require "$base_path/ver_asesorias_red.php";
                break;
            } else {
                require "$base_path/ver_mi_cronograma_linea.php";
                break;
            }
        case 'listado_convocatorias':
            require "$base_path/listar_convocatorias.php";
            break;
    }
    return true;
}

function asesoria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'asesores/pages/asesorias';
    switch ($page[1]) {
        case 'asignadas':
            set_input('guid_conv', $page[2]);
            require "$base_path/ver_investigaciones.php";
            break;
        case 'cronograma':
            if ($page[2] == 'red') {
                set_input('guid_inv', $page[3]);
                set_input('guid_red', $page[4]);
                require "$base_path/cronograma_red.php";
                break;
            } else {
                set_input('guid_inv', $page[2]);
                set_input('guid_conv', $page[3]);
                require "$base_path/cronograma.php";
                break;
            }
        case 'registrar':
            set_input('guid_inv', $page[2]);
            set_input('guid_conv', $page[3]);
            require "$base_path/registrar.php";
            break;
        case 'editar':
            set_input('guid_asesoria', $page[2]);
            require "$base_path/editar.php";
            break;
        case 'ver_sala':
            set_input('guid', $page[2]);
            require "$base_path/ver_sala.php";
            break;
        case 'subir_evidencia':
            set_input('guid_inv', $page[2]);
            set_input('guid_conv', $page[3]);
            set_input('id_asesoria', $page[4]);
            require "$base_path/admin_evidencias.php";
            break;
    }
}
