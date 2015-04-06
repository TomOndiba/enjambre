<?php

elgg_register_event_handler('init', 'system', 'busqueda_init'); 

function busqueda_init() {
    //agregar actions
//    $action_path = elgg_get_plugins_path() . "busqueda/actions/busqueda";
//    
//    elgg_register_action('busqueda/form_register', "$action_path/save_convocatoria.php", "logged_in");
 
    
    $url = "mod/busqueda/vendors/pagination_resultados.js";
    elgg_register_js('pagination/resultados', $url, 'head');
    
    
    elgg_register_ajax_view('busqueda/resultados');

    elgg_register_page_handler('busqueda', 'busqueda_page_handler');

//    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'busqueda_owner_block_menu');
    //registrar el menu busqueda en el header del tema ohyes
    elgg_register_event_handler('pagesetup', 'system', 'add_menu_busqueda');

}

function busqueda_page_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'busqueda/pages/busqueda';
    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = '';
    }

    switch ($page[0]) {
        case 'usuario':
            set_input("clave", $page[1]);
            require "$base_path/buscar.php";
            break;
        default:
            echo "request for $identifier $page[0]";
            break;
    }
    return true;
}
