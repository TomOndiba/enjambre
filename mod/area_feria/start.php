<?php

/**
 * Start que controla el plugin area_feria
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'area_feria_init');

function area_feria_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'area_feria/actions/area_feria';
    elgg_register_action("area_feria/create", "$base/save.php", "logged_in");
    elgg_register_action('area_feria/eliminar', "$base/delete.php", "logged_in");
    elgg_register_action('area_feria/edit_area', "$base/edit.php", "logged_in");

    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'area_feria/lib/lib_area.php';
    elgg_register_library('area', $lib);
    elgg_load_library('area');

    //Agrega js
    $url = "mod/area_feria/vendors/acciones_area.js";
    elgg_register_js('acciones_area', $url, 'head');
    elgg_extend_view('js/elgg', 'acciones_area/js');
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'area_owner_block_menu');

    //enrutador
    elgg_register_page_handler('area', 'area_page_handler');


    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'area_owner_block_menu');
}

function area_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'area_feria/pages/area_feria';
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
            require "$base_path/edit_area.php";
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
function area_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'area/crear';
        $item = new ElggMenuItem('Área de Feria', elgg_echo('Áreas de Ferias'), $url);
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
