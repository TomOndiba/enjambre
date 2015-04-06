<?php


elgg_register_event_handler('init', 'system', 'revistas_init');


function revistas_init() {

//agregar actions
    $action_path = elgg_get_plugins_path() . "revistas/actions/revistas";
    $action_path2 = elgg_get_plugins_path() . "revistas/actions/email_notificacion";
    elgg_register_action("revistas/create", "$action_path/create.php", "logged_in");
    elgg_register_action("email_notificacion/create", "$action_path2/create.php", "logged_in");
    $lib = elgg_get_plugins_path() . 'revistas/lib/lib_revistas.php';
    elgg_register_library('revistas', $lib);
    elgg_load_library('revistas');


//El enrutador
//elgg_register_page_handler('roles', 'roles_handler');
    elgg_register_page_handler('contenidos','contenidos_handler');
    elgg_register_page_handler('revistas', 'revistas_handler');
    elgg_register_page_handler('email_notificacion','email_notificacion_handler');      
    elgg_register_ajax_view("revistas/create");
    elgg_register_ajax_view("contenidos/contenidos");
    elgg_register_ajax_view("contenidos/cartillas");
    elgg_register_ajax_view("contenidos/contenidos_2");
    elgg_register_ajax_view("contenidos/cartillas_2");
    elgg_register_ajax_view("contenidos/tutoriales");
    elgg_register_ajax_view("revistas/listar_revistas");
    elgg_register_ajax_view("revistas/listar_revistas_2");
    
    
    $url = "mod/revistas/vendors/pagination-revistas.js";
    elgg_register_js('pag_revistas', $url, 'head');
    $url = "mod/revistas/vendors/pagination-revistas_2.js";
    elgg_register_js('pag_revistas_2', $url, 'head');

}
function revistas_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'revistas/pages/revistas';

    switch ($page[0]) {
        case '':
            require "$base_path/index_revistas.php";
            break;
    }
}

function contenidos_handler($page, $identifier){
	$plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'revistas/pages/contenidos';

    switch ($page[0]) {
        case '':
            require "$base_path/index.php";
            break;
        case 'tutoriales':
        	require "$base_path/index_tutoriales.php";
        	break;
    }
}

function email_notificacion_handler($page,$identifier){
	$plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'revistas/pages/email_notificacion';
    switch ($page[0]) {
        case '':
            require "$base_path/create.php";
            break;
    }
}
