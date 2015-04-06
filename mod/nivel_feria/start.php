<?php

/**
 * Start que controla el plugin nivel_feria
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'nivel_feria_init');

function nivel_feria_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'nivel_feria/actions/nivel_feria';
    elgg_register_action("nivel_feria/create", "$base/save.php", "logged_in");
    elgg_register_action('nivel_feria/eliminar', "$base/delete.php", "logged_in");
    elgg_register_action('nivel_feria/edit_nivel', "$base/edit.php", "logged_in");

    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'nivel_feria/lib/lib_nivel.php';
    elgg_register_library('nivel', $lib);
    elgg_load_library('nivel');

    //Agrega js
    $url = "mod/nivel_feria/vendors/acciones_nivel.js";
    elgg_register_js('acciones_nivel', $url, 'head');
    elgg_extend_view('js/elgg', 'acciones_nivel/js');
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'nivel_owner_block_menu');

    //enrutador
    elgg_register_page_handler('nivel', 'nivel_page_handler');


    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'nivel_owner_block_menu');
}

function nivel_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'nivel_feria/pages/nivel_feria';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
        case 'crear':
            require "$base_path/crear.php";
            break;
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
            require "$base_path/edit_nivel.php";
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
function nivel_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'nivel/crear';
        $item = new ElggMenuItem('Nivel de Feria', elgg_echo('Nivel de Ferias'), $url);
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
