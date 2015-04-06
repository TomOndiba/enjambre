<?php

elgg_register_event_handler('init', 'system', 'eventos_init');

function eventos_init() {
    //agregar actions
    $action_path = elgg_get_plugins_path()."eventos/actions/eventos";
    elgg_register_action('eventos/form_register_evento', "$action_path/save_evento_conv.php", "logged_in");
    elgg_register_action('eventos/form_register_asistencia', "$action_path/confirmar_asistencia.php", "logged_in");
    elgg_register_action('eventos/form_lista_nuevos_asistentes', "$action_path/registrar_asistencia.php", "logged_in");
    elgg_register_action('eventos/eliminar', "$action_path/delete_evento.php", "logged_in");
    elgg_register_action('eventos/form_edit_evento', "$action_path/update_evento.php", "logged_in");

    elgg_register_action('eventos/inscribirse', "$action_path/registrar_inscripcion.php", "logged_in");
    elgg_register_action('eventos/desinscribirse', "$action_path/eliminar_inscripcion.php", "logged_in");

    elgg_register_ajax_view('eventos/buscar');
    elgg_register_ajax_view('eventos/calendario/ver_evento');
    
    $url = "mod/eventos/vendors/busqueda.js";
    elgg_register_js('busqueda', $url, 'head');
    elgg_extend_view('js/elgg', 'eventos/js');
    
    $url = "mod/eventos/vendors/validarCampos.js";
    elgg_register_js('validarCampos', $url, 'head');
    elgg_extend_view('js/elgg', 'eventos/js');

    //agregar librerias
    $lib = elgg_get_plugins_path() . 'eventos/lib/lib_eventos.php';
    elgg_register_library('eventos', $lib);
    elgg_load_library('eventos');

    elgg_register_page_handler('eventos', 'evento_page_handler');
}

function evento_page_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'eventos/pages/eventos';
    
    switch ($page[0]) {
        case 'detalles':
            set_input("id_conv", $page[2]);
            set_input("id_evento", $page[1]);
            require "$base_path/detalles_evento.php";
            break; 
        case 'editar':
            set_input("id_conv", $page[2]);
            set_input("id_evento", $page[1]);
            require "$base_path/editar_evento.php";
            break;
        case 'listado':
            set_input("id_conv", $page[1]);
            require "$base_path/ver_eventos.php";
            break;
        case 'registro_evento':
            set_input("id", $page[1]);
            require "$base_path/register_evento.php";
            break;
        case 'inscribirse':
            set_input("id_evento", $page[1]);
            set_input("id_conv", $page[2]);
            require "$base_path/inscribirse.php";
            break;
        case 'registro_asistencia':
            set_input("id_evento", $page[1]);
            set_input("id_conv", $page[2]);
            require "$base_path/register_asistencia.php";
            break;
        case 'listar_asistentes':
            set_input("id_evento", $page[1]);
            set_input("id_conv", $page[2]);
            require "$base_path/listar_asistentes.php";
            break;
        case 'buscar_asistentes':
            set_input("id_evento", $page[1]);
            set_input("id_conv", $page[2]);
            require "$base_path/lista_buscar_asistentes.php";
            break;
        
        case 'registro_usuarios':
            set_input("id_evento", $page[1]);
            set_input("id_conv", $page[2]);
            require "$base_path/registrar_usuarios.php";
            break;
        default:
            echo "request for $identifier $page[0]";
            break;
    }
    return true;
}

