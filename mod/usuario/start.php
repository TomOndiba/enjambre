<?php

/**
 * Hello world plugin
 */
elgg_register_event_handler('init', 'system', 'usuario_init');

function usuario_init() {


    $action_path = elgg_get_plugins_path() . "usuario/actions/usuario";
    $action_path_2 = elgg_get_plugins_path() . "usuario/actions";
    elgg_register_action('usuario/register', "$action_path/save.php", "public");
    elgg_register_action('usuario/register_estudiante', "$action_path/save_estudiante.php", "public");
    elgg_register_action('usuario/register_estudiante_ext', "$action_path/save_estudiante.php", "public");
    elgg_register_action('usuario/add', "$action_path/add.php", "public");
    elgg_register_action('usuario/add_request', "$action_path/add_request.php", "public");
    elgg_register_action('usuario/update', "$action_path/update.php", "logged_in");
    elgg_register_action('usuario/login', "$action_path/login.php", "public");
    elgg_register_action('usuario/cambiar_password', "$action_path/cambiar_password.php", "logged_in");
    elgg_register_action('registro_total', "$action_path/registro_total.php", "public");

    //carga js

    $url = "mod/usuario/vendors/departamento_municipios.js";
    elgg_register_js('departamento_municipios', $url, 'head');

    $url = "mod/usuario/vendors/mostrarcampos.js";
    elgg_register_js('mostrarcampos', $url, 'head');
    elgg_extend_view('js/elgg', 'usuario/js');

    //agregar librerias

    $lib = elgg_get_plugins_path() . 'usuario/lib/lib_usuarios.php';
    elgg_register_library('usuarios', $lib);
    elgg_load_library('usuarios');

    elgg_register_ajax_view('usuario/listar_instituciones');
    elgg_register_ajax_view('usuario/busqueda_documento');
    elgg_register_ajax_view('usuario/validar_password');
    elgg_register_ajax_view('prueba_registro/registro');

    elgg_register_page_handler('usuario', 'usuario_handler');
}

function usuario_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'usuario/pages/usuario';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
        case 'registro':
            if ($page[1] == 'estudiante') {
                require "$base_path/registro_estudiante_ext.php";
            } else {
                set_input("evento", $page[1]);
                if (sizeof($page) > 2) {
                    set_input("id_conv", $page[2]);
                }
                require "$base_path/register.php";
            }
            break;
        case 'registro_estudiante':
            require "$base_path/registro_estudiante.php";
            break;
        case 'ver':
            set_input("id", $page[1]);
            require "$base_path/ver.php";
            break;
        case 'update':
            require"$base_path/update.php";
            break;
        default:
            echo 'no funciona';
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}
