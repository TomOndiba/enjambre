<?php

/**
 * Start que controla el plugin linea_tematica
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'patrocinadores_init');

function patrocinadores_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'patrocinadores/actions/patrocinadores';
    elgg_register_action("patrocinadores/create", "$base/save.php", "logged_in");
    elgg_register_action('patrocinadores/eliminar', "$base/delete.php", "logged_in");
    elgg_register_action('patrocinadores/edit_patrocinadores', "$base/edit.php", "logged_in");
    
    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'patrocinadores/lib/lib_patrocinadores.php';
    elgg_register_library('patrocinadores', $lib);
    elgg_load_library('patrocinadores');

    //Agrega js
    $url = "mod/patrocinadores/vendors/acciones_patrocinadores.js";
    elgg_register_js('acciones_patrocinadores', $url, 'head');
    elgg_extend_view('js/elgg', 'patrocinadores/js');
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'patrocinadores_owner_block_menu');

    //enrutador
    elgg_register_page_handler('patrocinadores', 'patrocinadores_page_handler');

  
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'patrocinadores_owner_block_menu');
}

function patrocinadores_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'patrocinadores/pages/patrocinadores';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
        case 'crear':
            require "$base_path/crear.php";
            break;
        case 'listar':
            require "$base_path/listar.php";
            break;
        case '':
       
            require "$base_path/listar.php";
            break;
        case 'eliminar':
            set_input("id", $page[1]);
            $url = $plugin_path . 'patrocinadores/actions/patrocinadores/delete.php';
            require "$url";
            break;
        case 'editar':
            set_input("id", $page[1]);
            require "$base_path/edit_patrocinadores.php";
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
function patrocinadores_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'patrocinadores/crear';
        $item = new ElggMenuItem('Patrocinadores', elgg_echo('Patrocinadores'), $url);
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
