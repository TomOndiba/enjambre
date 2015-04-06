<?php

/**
 * Describe plugin here
 */
elgg_register_event_handler('init', 'system', 'visitas_init');

function visitas_init() {
    $base_dir = elgg_get_plugins_path();

    //agregar librerias
    $lib = $base_dir . 'visitas/lib/visitas.php';
    elgg_register_library('visitas', $lib);
    elgg_load_library('visitas');


    //registrar actions
    $base = $base_dir . 'visitas/actions/visitas';
    elgg_register_action("visitas/create", "$base/save.php", "logged_in");
    elgg_register_action("visitas/register", "$base/register.php", "logged_in");
    elgg_register_action("visitas/editar_conv","$base/editar_conv.php","logged_in");
    elgg_register_action('visitas/delete_conv',"$base/delete_conv.php","logged_in");
    elgg_register_action("visitas/editar","$base/editar.php","logged_in");
    
    elgg_register_action("visitas/delete","$base/delete.php","logged_in");


    //borrar el item de grupos del menu
    //elgg_register_event_handler('pagesetup', 'system', 'borrar_menu_grupos',1000);
    elgg_register_plugin_hook_handler('register', 'topbar', 'add_menu_visitas');

    elgg_register_js('js.listar.visitas', 'mod/visitas/vendors/listar_visitas.js');
    elgg_extend_view('js/elgg', 'visitas/js');
    $url = "mod/visitas/vendors/visitas.css";
    elgg_register_css('lista_item', $url);
    //elgg_extend_view('css', 'visitas/css');

    //registrar el menu visitas en el tema Ohyes
    elgg_register_event_handler('pagesetup', 'system', 'add_menu_visitas');

    //registrar un manejador de rutas
    elgg_register_page_handler('visitas', 'visitas_page_handler');
    elgg_register_ajax_view('usuario/listar_instituciones');
    
}

/*
 * borra el menu grupos del sitio
 */

function borrar_menu_grupos() {
    elgg_unregister_menu_item('site', 'groups');
}

/**
 * Registra el menu visitas en el header del tema Ohyes de acuerdo al rol del usuario
 */
function add_menu_visitas() {
    //global $_SESSION;
    if (elgg_is_logged_in() && isset($_SESSION['roles'])) {
        $roles = $_SESSION['roles'];
        if (in_array('coordinador', $roles)) {
//        $item = new ElggMenuItem('visitas', elgg_echo("visitas:menubar"), 'visitas');
//        $item->setSection('topbar');
//        elgg_register_menu_item('site', $item);
            elgg_register_menu_item('site', array(
                'name' => 'Visitas',
                'text' => 'Visitas',
                'href' => 'visitas/',
            ));
            if (elgg_is_active_plugin('OhYesTheme')) {
                $OhyesTheme = new OhYesTheme;
                $OhyesTheme->register_menu_item('header', array(
                    'url' => elgg_get_site_url() . 'visitas/',
                    'title' => elgg_echo('ohyes:visitas'),
                    'text' => elgg_echo('ohyes:visitas'),
                    'image_class' => 'ohyes-theme-link-blog',
                ));
            }
        }
    }
}

function visitas_page_handler($page) {

    if (elgg_is_logged_in()) {
        $plugin_dir = elgg_get_plugins_path();
        $base_dir = $plugin_dir . "visitas/pages/visitas";

        $roles = $_SESSION['roles'];

        if (!in_array('coordinador', $roles)) {
            require "$base_dir/access_denied.php";
            return true;
        }


        if (count($page) == 0) { // rutas como pagina.com/visitas
            $page[0] = 'index';
        }
        switch ($page[0]) {
            case 'listar':
                if ($page[1] != '') {
                    set_input("id_conv", $page[1]);
                    require "{$base_dir}/lista_visitas_conv.php";
                    break;
                }
                break;
            case '':
            case 'index':
                //en el index se listan las visitas realizadas
                require "$base_dir/index.php";
                break;

            case 'registrar':
                if ($page[1] != '') {
                    set_input("id_conv", $page[1]);
                    
                    require "$base_dir/forms/register.php";
                    break;
                }
                //form de registro de las visitas externas
                require "$base_dir/forms/create.php";
                break;
            case 'editar':
                if ($page[1] != ''&&$page[2] != '') {
                    set_input("id_conv", $page[1]);
                    set_input("id_visita",$page[2]);
                    require "$base_dir/forms/editar_conv.php";
                    break;
                }
                set_input("id_visita",$page[1]);
                require "$base_dir/forms/editar.php";
                break;
            default:
                require "$base_dir/error404.php";
                break;
        }
    }
    return true;
}
