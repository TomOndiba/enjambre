<?php

elgg_register_event_handler('init', 'system', 'ferias_init');

function ferias_init() {
    //agregar actions
    $action_path = elgg_get_plugins_path() . "ferias/actions/ferias";
    $action_path_investigaciones = elgg_get_plugins_path() . "ferias/actions/investigaciones_feria";

    elgg_register_action('ferias/form_register', "$action_path/save_feria.php", "logged_in");
    elgg_register_action('ferias/desactivar_feria', "$action_path/desactivar_feria.php", "logged_in");
    elgg_register_action('ferias/activar_feria', "$action_path/activar_feria.php", "logged_in");    
    elgg_register_action('ferias/eliminar', "$action_path/delete_feria.php", "logged_in");
    elgg_register_action('ferias/edit_feria', "$action_path/edit_feria.php", "logged_in");
    elgg_register_action('ferias/vincular_area_nivel_feria', "$action_path/vincular_area_nivel_feria.php", "logged_in");
    elgg_register_action('ferias/desvincular_area_nivel_feria', "$action_path/desvincular_area_nivel_feria.php", "logged_in");
    elgg_register_action('ferias/vincular_patrocinador_feria', "$action_path/vincular_patrocinadores_feria.php", "logged_in");
    elgg_register_action('ferias/desvincular_patrocinadores_feria', "$action_path/desvincular_patrocinadores_feria.php", "logged_in");
    elgg_register_action('ferias/form_inscripcion', "$action_path/inscripcion_feria.php", "logged_in");
    elgg_register_action('ferias/acreditar', "$action_path_investigaciones/acreditar_participacion.php", "logged_in");
    elgg_register_action('ferias/evaluadores_aceptados', "$action_path_investigaciones/asignar_evaluador.php", "logged_in");
    elgg_register_action('ferias/seleccionar_finalista', "$action_path_investigaciones/seleccionar_finalista.php", "logged_in");
    elgg_register_action('ferias/quitar_finalista', "$action_path_investigaciones/quitar_finalista.php", "logged_in");
    elgg_register_action('ferias/notificar_finalistas', "$action_path_investigaciones/notificar_finalistas.php", "logged_in");
    elgg_register_action('ferias/incluir_municipales', "$action_path/incluir_municipales.php", "logged_in");
    
    elgg_register_ajax_view('ferias/selec_instituciones');
    elgg_register_ajax_view('ferias/tipo_institucional');
    elgg_register_ajax_view('ferias/listarFerias');
    elgg_register_ajax_view('ferias/listar_ferias_inactivas');
    elgg_register_ajax_view('ferias/municipios');
    elgg_register_ajax_view('ferias/departamentos');
    elgg_register_ajax_view('investigaciones_feria/inscritas/ver_inscritas');
    elgg_register_ajax_view('investigaciones_feria/acreditadas/ver_acreditadas');
    elgg_register_ajax_view('investigaciones_feria/acreditadas/evaluadores/seleccionar_evaluador');
    elgg_register_ajax_view('investigaciones_feria/evaluadas_inicialmente/ver_evaluadas_inicialmente');
    elgg_register_ajax_view('investigaciones_feria/evaluadas_inicialmente/evaluadores_sitio/seleccionar_evaluador');
    elgg_register_ajax_view('investigaciones_feria/evaluadas_en_sitio/ver_evaluadas_en_sitio');
    elgg_register_ajax_view('investigaciones_feria/finalistas/ver_finalistas');
    
    elgg_register_ajax_view('evaluadores_feria/evaluadores_aceptados');
    elgg_register_ajax_view('evaluadores_feria/evaluadores_no_aceptados');
    
    
    elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'feria_icon_url_override');
//
//    // Register an icon handler for groups
    elgg_register_page_handler('groupicon4', 'feria_icon_handler');
    
    //agregar librerias
    $lib = elgg_get_plugins_path() . 'ferias/lib/lib_ferias.php';
    elgg_register_library('ferias', $lib);
    elgg_load_library('ferias');

    //carga js
    $url = "mod/ferias/vendors/confirmacion_feria.js";
    elgg_register_js('confirmacion_feria', $url, 'head');
    elgg_extend_view('js/elgg', 'convocatorias/js');
    
    $url = "mod/ferias/vendors/imprimir_contenido.js";
    elgg_register_js('imprimir_contenido', $url);
    
    $url = "mod/ferias/vendors/pagination_ajax.js";
    elgg_register_js('pagination/ferias', $url, 'head');
    
    $url = "mod/ferias/vendors/paginationinactivas_ajax.js";
    elgg_register_js('pagination/feriasInactivas', $url, 'head');
    
    $url = "mod/ferias/vendors/validaCampos1.js";
    elgg_register_js('validaCampos1', $url, 'head');
    elgg_extend_view('js/elgg', 'ferias/js');
    elgg_register_page_handler('ferias', 'feria_page_handler');

    $url = "mod/ferias/vendors/investigaciones-feria.js";
    elgg_register_js('investigaciones-feria', $url, 'head');

    $url = "mod/ferias/vendors/departamento_municipio.js";
    elgg_register_js('departamento_municipio', $url, 'head');

    $url = "mod/ferias/vendors/tipo-feria.js";
    elgg_register_js('tipo-feria', $url, 'head');

    $url = "mod/ferias/vendors/imprimir_contenido.js";
    elgg_register_js('imprimir_contenido', $url, 'head');
    
    $url = "mod/convocatorias/vendors/vincular-evaluadores.js";
    elgg_register_js('vincular-evaluadores', $url, 'head');
    //registrando el handler de vincular evaluadores
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'feria_owner_block_menu');
    //registrar el menu ferias en el header del tema ohyes
    elgg_register_event_handler('pagesetup', 'system', 'add_menu_ferias');
}

/**
 * Registra el menu de feria en el header menu del tema Ohyes
 * de acuerdo al rol del usuario 
 */
function add_menu_ferias() {
    if (elgg_is_logged_in() && isset($_SESSION['roles'])) {
        $roles = $_SESSION['roles'];
        if (in_array('coordinador', $roles)) {
            if (elgg_is_active_plugin('OhYesTheme')) {
                $OhyesTheme = new OhYesTheme;
                $OhyesTheme->register_menu_item('header', array(
                    'url' => elgg_get_site_url() . "ferias/listado",
                    'title' => elgg_echo('ohyes:feria'),
                    'text' => elgg_echo('ohyes:feria'),
                    'image_class' => 'ohyes-theme-link-blog',
                ));
            }
            elgg_register_menu_item('site', array(
                'name' => 'feria',
                'text' => 'Ferias',
                'href' => 'ferias/listado',
            ));
        }
    }
}

function feria_page_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'ferias/pages/ferias';
    $base_path_investigaciones = $plugin_path . 'ferias/pages/investigaciones_feria';
    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = 'listado';
    }

    switch ($page[0]) {
        case '':
        case 'listado':
            require "$base_path/ver_ferias.php";
            break;
        case 'registro':
            require "$base_path/register.php";
            break;
        case 'detalles':
            set_input("id", $page[1]);
            require "$base_path/detalles_feria.php";
            break;
        case 'edit':
            set_input("id", $page[1]);
            require "$base_path/edit_feria.php";
            break;
        case 'asociar':
            set_input("id", $page[1]);
            require "$base_path/vincular_area_nivel_feria.php";
            break;
        case 'asociar_patro':
            set_input("id", $page[1]);
            require "$base_path/vincular_patrocinador_feria.php";
            break;
        case 'inscripcion':
            set_input("id_inv", $page[1]);
            set_input("id_group", $page[2]);
            set_input("id_feria", $page[3]);
            require "$base_path/form_inscripcion.php";
            break;
        case 'investigaciones':
            set_input("id", $page[1]);
            require "$base_path_investigaciones/ver_investigaciones.php";
            break;
        case 'vincular_evaluador_feria':
            vincular_evaluador_feria_handler($page);
            break;
        case 'evaluadores_feria':
            vincular_evaluador_feria_handler($page);
            break;
        case 'ver_municipales_disponibles':
            set_input("id", $page[1]);
            require "$base_path/ver_ferias_munic_disponibles.php";
            break;
        case 'listar_inactivas':
            require "$base_path/ver_ferias_inactivas.php";
            break;
       
        
        default:
            echo "request for $identifier $page[0]";
            break;
    }
    return true;
}

/**
 * Add a menu item to the user ownerblock
 */
function feria_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'ferias/listado';
        $item = new ElggMenuItem('Feria', elgg_echo('Ferias'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->feria_enable != "no") {
            $url = "feria/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('feria', elgg_echo('feria:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

/**
 * Función heandler para redireccionar a los page de los evaluadores_feria
 * @param type $page -> variable que se recibe en la url.
 */
function vincular_evaluador_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'ferias/pages/evaluadores';
    switch ($page[1]) {
        case "evaluadores_feria":
            set_input("guid", $page[2]);
            require "{$base_path}/vincular_evaluadores_feria.php";
            break;
        case "ver":
            set_input("guid", $page[2]);
            require "{$base_path}/evaluadores_feria.php";
            break;
    }
}
