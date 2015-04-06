<?php

elgg_register_event_handler('init', 'system', 'tema_init');

function tema_init() {
    $action_path = elgg_get_plugins_path() . "tema_comunidad_ondas/actions";
    elgg_unregister_page_handler('profile', 'profile_page_handler');
    elgg_register_page_handler('profile', 'nuevo_profile_page_handler');
    elgg_register_page_handler('soporte', 'soporte_page_handler');

    $url = "mod/tema_comunidad_ondas/vendors/css/inicio.css";
    elgg_register_css('inicio', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/logged.css";
    elgg_register_css('logged', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/investigaciones.css";
    elgg_register_css('investigaciones', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/jovenes.css";
    elgg_register_css('jovenes', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/maestro.css";
    elgg_register_css('maestro', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/grupo_investigacion.css";
    elgg_register_css('grupos_investigacion', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/ferias.css";
    elgg_register_css('ferias', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/redes_tematicas.css";
    elgg_register_css('redes_tematicas', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/coordinacion.css";
    elgg_register_css('coordinacion', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/reveal/reveal.css";
    elgg_register_css('reveal', $url);

    $url = "mod/tema_comunidad_ondas/vendors/css/bitacoras/bitacoras.css";
    elgg_register_css('bitacoras', $url);

    $url = "mod/tema_comunidad_ondas/vendors/js/slider/slider.js";
    elgg_register_js('slider', $url, 'head');

    $url = "mod/tema_comunidad_ondas/vendors/js/turn/turn.js";
    elgg_register_js('turn', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/js/dataTable/dataTables.js";
    elgg_register_js('data_table', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/js/estado/control_estado.js";
    elgg_register_js('control_estado', $url, 'head');

    $url = "mod/tema_comunidad_ondas/vendors/js/jquery.reveal.js";
    elgg_register_js('reveal', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/js/timer/timer.js";
    elgg_register_js('timer', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/js/fechas/fechas.js";
    elgg_register_js('fechas', $url, 'head');

    $url = "mod/tema_comunidad_ondas/vendors/js/miniaturas/miniaturas.js";
    elgg_register_js('miniaturas', $url, 'head');

    $url = "mod/tema_comunidad_ondas/vendors/js/investigaciones.js";
    elgg_register_js('investigaciones', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/js/scrollbar/perfect.js";
    elgg_register_js('perfect', $url, 'head');

    $url = "mod/tema_comunidad_ondas/vendors/js/reveal-old/reveal.js";
    elgg_register_js('reveal2', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/js/busqueda_gral.js";
    elgg_register_js('busqueda_gral', $url, 'head');
    $url = "mod/tema_comunidad_ondas/vendors/js/rate/raty.js";
    elgg_register_js('raty', $url, 'head');
    
     $url = "mod/tema_comunidad_ondas/vendors/js/input/file.js";
    elgg_register_js('file', $url, 'head');
     
    $url = "mod/tema_comunidad_ondas/vendors/tiempo/TimeCircles.js";
    elgg_register_js('time', $url, 'head');
    
    $url = "mod/tema_comunidad_ondas/vendors/pagination_ajax_amigos.js";
    elgg_register_js('amigos', $url, 'head');

    $url = "mod/tema_comunidad_ondas/vendors/js/validate/validate.js";
    elgg_register_js('validate', $url, 'head');
    
     $url = "mod/tema_comunidad_ondas/vendors/js/datepick/datepick.js";
    elgg_register_js('datepick', $url, 'head');
    
    
    //REGISTRO DE ACTIONS
    elgg_register_action('agregar_amigo', "$action_path/agregar_amigo.php", "logged_in");
    elgg_register_action('tema_comunidad_ondas/delete_friend', "$action_path/delete_friend.php", "logged_in");
    elgg_register_ajax_view("info/user");
    elgg_register_ajax_view("info/likes");
    elgg_register_ajax_view("actions/iniciar_grupos");
    elgg_register_ajax_view("info/mensajes");
    elgg_register_ajax_view("info/notificaciones");
    elgg_register_ajax_view("profile/ver_mis_amigos");

}

function nuevo_profile_page_handler($page) {
    elgg_load_css('logged');
    
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'tema_comunidad_ondas/pages/album';
    $base_path_mis_grupos = $plugin_path . 'tema_comunidad_ondas/pages/mis_grupos';
    $base_path_mis_redes = $plugin_path . 'tema_comunidad_ondas/pages/mis_redes';
    $base_path_mi_informacion = $plugin_path . 'tema_comunidad_ondas/pages/informacion';
    $base_path_mis_amigos = $plugin_path . 'tema_comunidad_ondas/pages/mis_amigos'; 
    $username = $page[0];
    $user = get_user_by_username($username);
//    if ($user->getSubtype() == "maestro") {
//        elgg_load_css("maestro");
//    } else if (elgg_age_user($user) == 2) {
//        elgg_load_css("jovenes");
//    }
    if (isset($page[0])) {
        $username = $page[0];
        $user = get_user_by_username($username);
        elgg_set_page_owner_guid($user->guid);
    }

    // short circuit if invalid or banned username
    if (!$user || ($user->isBanned() && !elgg_is_admin_logged_in())) {
        register_error(elgg_echo('profile:notfound'));
        forward();
    }

    $action = NULL;
    if (isset($page[1])) {
        $action = $page[1];
    }

    if ($action == 'edit') {
        // use the core profile edit page
//        $base_dir = elgg_get_root_path();
//        require "{$base_dir}pages/profile/edit.php";
        $base_dir = $plugin_path.'usuario/';
        require "{$base_dir}pages/usuario/update.php";
        
        return true;
    }
    if($action=='cambiar_password'){
        $base_dir = $plugin_path.'usuario/';
        require "{$base_dir}pages/usuario/cambiar_password.php";
        return true;
    }
    
    if($action == 'amigos'){
        set_input("user", $user->guid);
        require $base_path_mis_amigos . "/ver_mis_amigos.php";
        return true;
        
    }
    if($action == 'solicitudes'){
        set_input("user", $user->guid);
        require $base_path_mis_amigos . "/solicitudes.php";
        return true;
        
    }
    if ($action == 'fotos') {
        switch ($page[2]) {
            case "":
                set_input("user", $user->guid);
                require $base_path . "/ver_albunes.php";
                break;
            case "crear_album":
                set_input("user", $user->guid);
                require $base_path . "/crear_album.php";
                break;
            default:
                set_input("user", $user->guid);
                set_input("album", $page[2]);
                require $base_path . "/ver_album.php";
                break;
        }

        return true;
    }if ($action == 'grupos') {
        set_input("user", $user->guid);
        require $base_path_mis_grupos . "/ver_mis_grupos.php";
        return true;
    } else if ($action == 'redes') {
        
        set_input("user", $user->guid);
        require $base_path_mis_redes . "/ver_mis_redes.php";
        return true;
    } 
      else if ($action == 'informacion') {
        set_input("user", $user->guid);
        require  $base_path_mi_informacion . "/informacion.php";
        return true;
    }
    
    else {


//	$content = elgg_view_layout('widgets', $params);
        elgg_load_css('logged');
        $body = array('izquierda' => elgg_view('profile/menu', array('user' => $user)), 'derecha' => elgg_view('profile/muro'));
        echo elgg_view_page($user->name, $body, "profile", array('user' => $user));
        return true;
    }
}


function soporte_page_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'tema_comunidad_ondas/pages/soporte';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
        case '':
          
            require "$base_path/contacto.php";
            break;

        default:
            echo 'no funciona';
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}