<?php

elgg_register_event_handler('init', 'system', 'convocatorias_init');

function convocatorias_init() {
    //agregar actions
    #Rutas de los actions
    $action_path = elgg_get_plugins_path() . "convocatorias/actions/convocatorias";
    $action_path_asesores = elgg_get_plugins_path() . "convocatorias/actions/asesores";
    $action_path_investigaciones = elgg_get_plugins_path() . "convocatorias/actions/investigaciones";
    $action_path_acta_seleccion = elgg_get_plugins_path() . "/bitacoras/actions/bitacoras";
    
    # Nuevas pages para las convocatorias
    $action_path_iniciativas = elgg_get_plugins_path() . "convocatorias/actions/iniciativa";
    $action_path_asesores = elgg_get_plugins_path() . "convocatorias/actions/asesores";


    elgg_register_action('convocatorias/form_register', "$action_path/save_convocatoria.php", "logged_in");
    elgg_register_action('convocatorias/listado_lineas', "$action_path/save_lineas_conv.php", "logged_in");
    elgg_register_action('convocatorias/eliminar', "$action_path/delete_convocatoria.php", "logged_in");
    elgg_register_action('convocatorias/desasociar', "$action_path/delete_lineas_conv.php", "logged_in");
    elgg_register_action('convocatorias/edit_convocatoria', "$action_path/edit_convocatoria.php", "logged_in");
    elgg_register_action('convocatorias/desactivar', "$action_path/desactivar_convocatoria.php", "logged_in");
    elgg_register_action('convocatorias/habilitar', "$action_path/habilitar_convocatoria.php", "logged_in");

    elgg_register_action('convocatorias/evaluar_asesor', "$action_path_asesores/vincular_asesor.php", "logged_in");
    elgg_register_action('asesores/notificar_asesores', "$action_path_asesores/notificar_asesores.php", "logged_in");
    elgg_register_action('asesores/desvincular_asesor', "$action_path_asesores/desvincular_asesor.php", "logged_in");

    elgg_register_action('convocatorias/aprobar_investigaciones', "$action_path_investigaciones/aprobar_investigaciones.php", "logged_in");
    elgg_register_action('convocatorias/evaluadores_aceptados', "$action_path_investigaciones/evaluadores_aceptados.php", "logged_in");
    elgg_register_action('convocatorias/asesores_aceptados', "$action_path_investigaciones/asesores_aceptados.php", "logged_in");
    elgg_register_action('convocatorias/aprobar_financiacion', "$action_path_investigaciones/aprobar_financiacion.php", "logged_in");
    elgg_register_action('investigaciones/seleccionadas/presupuesto_inv', "$action_path_investigaciones/asignar_presupuesto.php", "logged_in");
    elgg_register_action('investigaciones/preinscritas/cambiar_linea', "$action_path_investigaciones/cambiar_linea.php", "logged_in");
    elgg_register_action('acta_de_seleccion/acta_de_seleccion', "$action_path_acta_seleccion/print.php", "logged_in");
    elgg_register_action('investigaciones/seleccionar_elegibles', "$action_path_investigaciones/invitar_investigaciones.php", "logged_in");

    elgg_register_action('investigaciones/aceptar_invitacion', "$action_path_investigaciones/aceptar_invitacion.php", "logged_in");
    elgg_register_action('investigaciones/rechazar_invitacion', "$action_path_investigaciones/rechazar_invitacion.php", "logged_in");


    #Action para nuevas convocatorias
    elgg_register_action("iniciativa/rechazar_iniciativa", "$action_path_iniciativas/rechazar_iniciativa.php");
    elgg_register_action("iniciativa/aceptar_iniciativa", "$action_path_iniciativas/aceptar_iniciativa.php");
    elgg_register_action("usuario/register_asesor", "{$action_path_asesores}/save_asesor.php");
    elgg_register_action("asesores/asignar_a_investigacion", "{$action_path_asesores}/asignar_a_investigacion.php");


    elgg_register_ajax_view('investigaciones/preseleccionadas/modificar_evaluacion');
    elgg_register_ajax_view('convocatorias/listarConvocatorias');
    elgg_register_ajax_view('convocatorias/listar_inactivas');
    elgg_register_ajax_view('convocatorias/lista_lineas');
    elgg_register_ajax_view('investigaciones/listar_investigaciones');
    elgg_register_ajax_view('evaluadores_conv/vincular_evaluadores');
    elgg_register_ajax_view('investigaciones/inscritas/evaluadores/seleccionar_evaluador');
    elgg_register_ajax_view('investigaciones/preinscritas/ver_preinscritas');
    elgg_register_ajax_view('investigaciones/inscritas/ver_inscritas');
    elgg_register_ajax_view('investigaciones/seleccionadas/ver_seleccionadas');
    elgg_register_ajax_view('investigaciones/seleccionadas/asesores/seleccionar_asesor');
    elgg_register_ajax_view('investigaciones/seleccionadas/acta_seleccion/acta_seleccion'); //acta_seleccion
    elgg_register_ajax_view('investigaciones/preseleccionadas/ver_preseleccionadas');
    elgg_register_ajax_view('investigaciones/preinscritas/lineas_convocatoria_tipo');
    elgg_register_ajax_view('asesores/add_asesor');
    elgg_register_ajax_view('administracion/listado_grupos_inactivos');
    elgg_register_ajax_view('administracion/listado_redes_inactivas');
    elgg_register_ajax_view('administracion/administrar_inhabilitadas');

    //agregar librerias
    $lib = elgg_get_plugins_path() . 'convocatorias/lib/lib_convocatorias.php';
    elgg_register_library('convocatorias', $lib);
    elgg_load_library('convocatorias');

    //carga js
    $url = "mod/convocatorias/vendors/confirmacion.js";
    elgg_register_js('confirmacion', $url, 'head');
    elgg_extend_view('js/elgg', 'convocatorias/js');


    $url = "mod/convocatorias/vendors/vincular-asesores.js";
    elgg_register_js('vincular-asesores', $url, 'head');


    $url = "mod/convocatorias/vendors/asesores.js";
    elgg_register_js('asesores', $url, 'head');

    $url = "mod/convocatorias/vendors/vista_modal1.js";
    elgg_register_js('vista_modal1', $url, 'head');

    $url = "mod/convocatorias/vendors/presupuesto.js";
    elgg_register_js('presupuesto', $url, 'head');

    $url = "mod/convocatorias/vendors/jquery-1.9.1.js";
    elgg_register_js('jquery-1.9.1', $url, 'head');
    elgg_extend_view('js/elgg', 'convocatorias/js');

    $url = "mod/convocatorias/vendors/suma.js";
    elgg_register_js('suma', $url, 'head');
    elgg_extend_view('js/elgg', 'convocatorias/js');

    $url = "mod/convocatorias/vendors/jquery-ui.js";
    elgg_register_js('jquery-ui', $url, 'head');

    $url = "mod/convocatorias/vendors/validaCampos.js";
    elgg_register_js('validaCampos', $url, 'head');
    elgg_extend_view('js/elgg', 'convocatorias/js');


    $url = "mod/convocatorias/vendors/pagination_ajax.js";
    elgg_register_js('pagination/convocatorias', $url, 'head');

    $url = "mod/convocatorias/vendors/pagination_inactivas.js";
    elgg_register_js('pagination/inactivas', $url, 'head');


    $url = "mod/convocatorias/vendors/investigaciones-convocatoria.js";
    elgg_register_js('investigaciones-convocatoria', $url, 'head');

    $url = "mod/convocatorias/vendors/lista_investigaciones.js";
    elgg_register_js('lista-investigaciones', $url, 'head');

    $url = "mod/convocatorias/vendors/pagination_evaluadores.js";
    elgg_register_js('paginat/evaluadores', $url, 'head');

    $url = "mod/convocatorias/vendors/vincular-evaluadores.js";
    elgg_register_js('vincular-evaluadores', $url, 'head');

    $url = "mod/convocatorias/vendors/pagination_grupos_inactivos.js";
    elgg_register_js('grupos-inactivos', $url, 'head');

    $url = "mod/convocatorias/vendors/pagination_redes_inactivas.js";
    elgg_register_js('redes-inactivas', $url, 'head');

    $url = "mod/convocatorias/vendors/pagination_instituciones_inactivas.js";
    elgg_register_js('instituciones-inactivas', $url, 'head');

//carga css
    $url = "mod/convocatorias/vendors/jquery-ui.css";
    elgg_register_css('jquery-ui', $url, 'head');
    elgg_extend_view('css/elgg', 'convocatorias/css');

    $url = "mod/convocatorias/vendors/buscar_lineas_tipo.js";
    elgg_register_js('buscar_lineas_tipo', $url, 'head');
    elgg_extend_view('js/elgg', 'convocatorias/js');


    elgg_register_page_handler('convocatorias', 'convocatoria_page_handler');

    elgg_register_page_handler('ver_eventos_convocatoria', 'eventos_convocatoria_handler');
    //registrando el handler de vincular evaluadores
    elgg_register_page_handler('aceptar_evaluadores', 'vincular_evaluador_handler');
    elgg_register_page_handler('acta_seleccion', 'acta_de_seleccion_handler');

    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'convocatoria_owner_block_menu');
    //registrar el menu convocatorias en el header del tema ohyes
    elgg_register_event_handler('pagesetup', 'system', 'add_menu_convocatorias');

//    elgg_register_menu_item('site', array(
//        'name' => 'convocatoria',
//        'text' => 'Convocatorias',
//        'href' => 'convocatorias/',
//    ));
}

/**
 * Registra el menu de convocatoria en el header menu del tema Ohyes
 * de acuerdo al rol del usuario 
 */
function add_menu_convocatorias() {
    if (elgg_is_logged_in() && isset($_SESSION['roles'])) {
        $roles = $_SESSION['roles'];
        if (in_array('coordinador', $roles)) {
            if (elgg_is_active_plugin('OhYesTheme')) {
                $OhyesTheme = new OhYesTheme;
                $OhyesTheme->register_menu_item('header', array(
                    'url' => elgg_get_site_url() . "convocatorias/",
                    'title' => elgg_echo('ohyes:convocatoria'),
                    'text' => elgg_echo('ohyes:convocatoria'),
                    'image_class' => 'ohyes-theme-link-blog',
                ));
            }
            elgg_register_menu_item('site', array(
                'name' => 'convocatoria',
                'text' => 'Convocatorias',
                'href' => 'convocatorias/',
            ));
        }
    }
}

function convocatoria_page_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'convocatorias/pages/convocatorias';
    $base_path_investigaciones = $plugin_path . 'convocatorias/pages/investigaciones';
    $base_path_asesores = $plugin_path . 'convocatorias/pages/asesores';
    $base_path_administracion = $plugin_path . 'convocatorias/pages/administracion';

    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = 'listado';
    }

    switch ($page[0]) {
        case 'ver':
            set_input("id_conv", $page[1]);
            require "$base_path/ver_convocatoria.php";
            break;
        case '':

        case 'listado':
            require "$base_path/ver_convocatorias.php";
            break;
        case 'registro':
            require "$base_path/register.php";
            break;
        case 'lineas':
            set_input("id", $page[1]);
            require "$base_path/cambiar_lineas.php";
            break;
        case 'detalles':
            set_input("id", $page[1]);
            require "$base_path/detalles_convocatoria.php";
            break;
        case 'edit':
            set_input("id", $page[1]);
            require "$base_path/edit_convocatoria.php";
            break;
        case 'investigaciones':
            set_input("id", $page[1]);
            require "$base_path_investigaciones/ver_investigaciones.php";
            break;
        case 'especial':
            if ($page[1] == 'iniciativas') {
                set_input("id", $page[2]);
                require "{$base_path_investigaciones}/especiales/inscritas.php";
                break;
            }else{
                set_input("id", $page[2]);
                require "{$base_path_investigaciones}/especiales/investigaciones.php";
                break;
            }
        case 'vinculacion':
            vincular_handler($page);
            break;
        case 'vincular_evaluador':
            vincular_evaluador_handler($page);
            break;
        case 'presupuesto_investigaciones':
            set_input("id", $page[1]);
            require "$base_path_investigaciones/presupuesto_investigaciones.php";
            break;
        case 'ver_eventos':
            eventos_convocatoria_handler($page);
            break;

        case 'listar_inactivas':
            require "$base_path/listar_inactivas.php";
            break;

        case 'banco_elegibles':
            set_input("id", $page[1]);
            require "$base_path_investigaciones/banco_elegibles.php";
            break;

        case 'invitacion':
            set_input("id_conv", $page[1]);
            set_input("id_inv", $page[2]);
            set_input("id_linea", $page[3]);
            require "$base_path_investigaciones/responder_invitacion.php";
            break;

        case 'administracion':
            require "$base_path_administracion/administrar.php";
            break;

        case 'listar_grupos_inactivos':
            require "$base_path_administracion/listar_grupos_inactivos.php";
            break;

        case 'listar_redes_inactivas':
            require "$base_path_administracion/listar_redes_inactivas.php";
            break;
        case 'asesores':
            if($page[2] == "registro"){
                set_input("convocatoria", $page[1]);
                require "{$base_path_asesores}/registrar_asesor.php";
                break;
            }else{
                set_input("convocatoria", $page[1]);
                require "{$base_path_asesores}/lista_asesores.php";
                break;
            }
        default:
            echo "request for $identifier $page[0]";
            break;
    }
    return true;
}

/**
 * Add a menu item to the user ownerblock
 */
function convocatoria_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'convocatorias/listado';
        $item = new ElggMenuItem('Convocatoria', elgg_echo('Convocatorias'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->convocatoria_enable != "no") {
            $url = "convocatoria/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('convocatoria', elgg_echo('convocatoria:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

function vincular_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'convocatorias/pages/asesores';
    switch ($page[1]) {
        case "asesores":
            set_input("guid", $page[2]);
            require "{$base_path}/vincular_asesores.php";
            break;
    }
}

function eventos_convocatoria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'eventos/pages/calendario';
    switch ($page[1]) {
        case "calendario":
            set_input("guid", $page[2]);
            require "{$base_path}/ver_calendario_convocatoria.php";
            break;
    }
}

/**
 * Función heandler para redireccionar a los page de los evaluadores
 * @param type $page -> variable que se recibe en la url.
 */
function vincular_evaluador_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'convocatorias/pages/evaluadores';
    switch ($page[1]) {
        case "evaluadores":

            set_input("guid", $page[2]);
            require "{$base_path}/vincular_evaluadores.php";
            break;
        case "asignar_proyectos":
            set_input("guid", $page[2]);
            require "{$base_path}/asignar_proyectos_evaluadores.php";
            break;
    }

    /**
     * Función heandler para redireccionar a los page de acta_seleccion
     * @param type $page -> variable que se recibe en la url.
     */
    function acta_de_seleccion_handler($page) {
        $plugin_path = elgg_get_plugins_path();
        $base_path = $plugin_path . 'convocatorias/pages/acta_de_seleccion';
        switch ($page[1]) {
            case "acta":
                set_input("guid", $page[2]);
                require "{$base_path}/acta_de_seleccion.php";
                break;
        }
    }

}
