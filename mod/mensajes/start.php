<?php

elgg_register_event_handler('init', 'system', 'mensajes_init');

function mensajes_init() {

    elgg_register_page_handler('mensajes', 'mensajes_handler');
    $action_path = elgg_get_plugins_path() . "mensajes/actions/mensajes";

    //Actions
    elgg_register_action('mensajes/lista', "$action_path/eliminar_mensajes.php", "logged_in");
    elgg_register_action('mensajes/redactar_mensaje', "$action_path/enviar_mensaje.php", "logged_in");
    elgg_register_action('mensajes/lista_enviados', "$action_path/eliminar_mensajes_enviados.php", "logged_in");

    //Vistas Ajax
    elgg_register_ajax_view("mensajes/pagina_mensajes");
    elgg_register_ajax_view("mensajes/pagina_mensajes_enviados");
}

function mensajes_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'mensajes/pages/mensajes';
    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = 'inbox';
    }
    switch ($page[0]) {
        case 'inbox':
            require "$base_path/inbox.php";
            break;
        case 'enviados':
            require "$base_path/enviados.php";
            break;
        case 'redactar':
            require "$base_path/redactar.php";
            break;
        case 'ver':
            set_input('id_mensaje', $page[1]);
            require "$base_path/ver.php";
            break;
    }
}
