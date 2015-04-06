<?php

elgg_register_event_handler('init', 'system', 'comentarios_init');

function comentarios_init() {
    //cargar Librerias del albunes
    $lib = elgg_get_plugins_path() . 'comentarios/lib/lib_comentarios.php';
    elgg_register_library('comentarios', $lib);
    elgg_load_library('comentarios');

    $action_path = elgg_get_plugins_path() . 'album/actions/comentarios';
    elgg_register_ajax_view("comentarios/add_comment");
    elgg_register_ajax_view("like/add_like_entity");
    elgg_register_ajax_view("like/add_like_annotation");
    elgg_register_ajax_view("like/remove_like_annotation");
    elgg_register_ajax_view("like/remove_like_entity");
    
    //REGISTRAR JS
    $url = "mod/comentarios/vendors/js/ajax-comentarios.js";
    elgg_register_js('ajax_comentarios', $url, 'head');
    
    
}
