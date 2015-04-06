<?php

elgg_register_event_handler('init', 'system', 'album_init');

function album_init() {
    //cargar Librerias del albunes
    $lib = elgg_get_plugins_path() . 'album/lib/lib_album.php';
    elgg_register_library('album', $lib);
    elgg_load_library('album');

    $action_path = elgg_get_plugins_path() . 'album/actions/album';
    elgg_register_action('album/crear_album', "$action_path/crear_album.php", "logged_in");
    elgg_register_action('album/add_fotos_album', "$action_path/add_fotos_album.php", "logged_in");
    elgg_register_action('album/delete_foto', "$action_path/delete_foto.php", "logged_in");
    elgg_register_action('album/delete_album', "$action_path/delete_album","logged_in");
    
    
    //cargar_vistas_ajax
    elgg_register_ajax_view("album/ver_album");
    elgg_register_ajax_view("foto/ver_foto");
    elgg_register_ajax_view("foto/comentarios/add_comment");
    elgg_register_ajax_view("album/crear_album");
    
    //REGISTRAR JS
    $url = "mod/album/vendors/ajax_album.js";
    elgg_register_js('ajax_album', $url, 'head');
    $url = "mod/album/vendors/visor_fotos.js";
    elgg_register_js('visor_js', $url, 'head');
    
  
}
