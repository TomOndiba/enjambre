<?php

/**
 * Start que controla el plugin linea_tematica
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'linea_tematica_init');

function linea_tematica_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'linea_tematica/actions/linea_tematica';
    elgg_register_action("linea_tematica/create", "$base/save.php", "logged_in");
    elgg_register_action('linea_tematica/eliminar', "$base/delete.php", "logged_in");
    elgg_register_action('linea_tematica/habilitar', "$base/habilitar.php", "logged_in");
    elgg_register_action('linea_tematica/edit_linea', "$base/edit.php", "logged_in");
    elgg_register_action('linea_tematica/cambiar_asesor', "$base/cambiar_asesor.php");
    elgg_register_action('linea_tematica/quitar_asesor', "$base/quitar_asesor.php");

    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'linea_tematica/lib/lib_linea.php';
    elgg_register_library('linea', $lib);
    elgg_load_library('linea');

    //Agrega js
    $url = "mod/linea_tematica/vendors/acciones.js";
    elgg_register_js('acciones_linea', $url, 'head');
    elgg_extend_view('js/elgg', 'linea_tematica/js');
    
    //Agrega js
    $url = "mod/linea_tematica/vendors/pagination_ajax.js";
    elgg_register_js('acciones_linea', $url, 'head');
    
    elgg_register_ajax_view('linea_tematica/ver');
    elgg_register_ajax_view('linea_tematica/cambiar_asesor');
    
    
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'linea_owner_block_menu');

    //enrutador
    elgg_register_page_handler('linea', 'linea_page_handler');

    //items en el menu
//    elgg_register_menu_item('page', array(
//        'name' => 'tematica',
//        'text' => 'Mis lineas tematicas',
//        'href' => 'linea/tematica',
//        'contexts' => array('linea'),
//    ));
    //items en el menu
//    elgg_register_menu_item('page', array(
//        'name' => 'crear',
//        'text' => 'Crear linea tematica',
//        'href' => 'linea/crear',
//        'contexts' => array('linea'),
//    ));
    //items en el menu
//    elgg_register_menu_item('page', array(
//        'name' => 'listar',
//        'text' => 'Listar lineas tematicas',
//        'href' => 'linea/listar',
//        'contexts' => array('linea'),
//    ));


    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'linea_owner_block_menu');
}

function linea_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'linea_tematica/pages/linea_tematica';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
//        case 'guardar':
//            set_input("id", $page[1]);
//            require "$base_path/createlinea.php";
//            break;
//        case 'tematica':
//            require "$base_path/tematica.php";
//            break;
        case 'crear':
            require "$base_path/crear.php";
            break;
        case '':
        case 'listar':
            require "$base_path/listar.php";
            break;
        case 'eliminar':
            set_input("id", $page[1]);
            $url = $plugin_path . 'linea_tematica/actions/linea_tematica/delete.php';
            require "$url";
            break;
        case 'editar':
      
            set_input("id", $page[1]);
            require "$base_path/edit_linea.php";
            break;
        case 'listar_deshabilitadas':
            require "$base_path/listar_deshabilitadas.php";
            break;
        default:
            echo "request for $identifier $page[0]";
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}

/**
 * Add a menu item to the user ownerblock
 */
function linea_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'linea/crear';
        $item = new ElggMenuItem('Lineas Tematicas', elgg_echo('Lineas Tematicas'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->file_enable != "no") {
            $url = "file/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('file', elgg_echo('file:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}
