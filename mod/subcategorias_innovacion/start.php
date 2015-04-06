<?php

/**
 * Start que controla el plugin subcategorías de innovación
 */
elgg_register_event_handler('init', 'system', 'subcategoria_innovacion_init');

function subcategoria_innovacion_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'subcategorias_innovacion/actions/subcategorias_innovacion';
    elgg_register_action("subcategorias_innovacion/create", "$base/save.php", "logged_in");
    elgg_register_action('subcategorias_innovacion/eliminar', "$base/delete.php", "logged_in");
    elgg_register_action('subcategorias_innovacion/edit_subcategoria', "$base/edit.php", "logged_in");

    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'subcategorias_innovacion/lib/lib_subcategoria.php';
    elgg_register_library('subcategoria', $lib);
    elgg_load_library('subcategoria');

    //Agrega js
    $url = "mod/subcategorias_innovacion/vendors/acciones_subcategoria.js";
    elgg_register_js('acciones_subcategoria', $url, 'head');
    elgg_extend_view('js/elgg', 'acciones_subcategoria/js');
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'subcategoria_owner_block_menu');

    //enrutador
    elgg_register_page_handler('subcategorias', 'subcategoria_page_handler');


    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'subcategoria_owner_block_menu');
}

function subcategoria_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'subcategorias_innovacion/pages/subcategorias_innovacion';
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
            $url = $plugin_path . 'subcategorias_innovacion/actions/subcategorias_innovacion/delete.php';
            require "$url";
            break;
        case 'editar':
            set_input("id", $page[1]);
            require "$base_path/edit_subcategoria.php";
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
function subcategoria_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'subcategoria/crear';
        $item = new ElggMenuItem('Subcategorías de Innovación', elgg_echo('Subcategorías de Innovación'), $url);
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
