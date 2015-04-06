<?php


elgg_register_event_handler('init', 'system', 'roles_init');

function roles_init() {

//agregar actions
    $action_path = elgg_get_plugins_path() . "roles/actions/admin/roles";
    elgg_register_action('admin/roles/register', "$action_path/register.php", "logged_in");
      elgg_register_action('admin/roles/eliminar',"$action_path/delete_rol.php","logged_in");


//Registrar Vistas en Ajax
    elgg_register_ajax_view('roles/asignar_roles_usuario');
    elgg_register_ajax_view('roles/seleccion_roles');
    elgg_register_ajax_view('roles/guardar_rol');
    elgg_register_ajax_view('roles/desasignar_rol');
    elgg_register_ajax_view('roles/buscar_usuario');
    
//carga js
    $url = "mod/roles/vendors/js/roles.js";
    elgg_register_js('mostrarinfo', $url, 'footer');
    elgg_extend_view('js/elgg', 'roles/ajax/js');
    
    $url2 = "mod/roles/vendors/js/confirmacion.js";
    elgg_register_js('roles/confirmacion', $url2, 'footer');
    
    
    $url = "mod/roles/vendors/js/jquery-1.9.1.js";
    elgg_register_js('jquery-1.9.1', $url, 'footer');
    
    $url = "mod/roles/vendors/js/jquery-ui.js";
    elgg_register_js('jquery-ui', $url, 'footer');
    
    
    $url = "mod/roles/vendors/js/jquery-ui.css";
    elgg_register_css('jquery-ui', $url, 'footer');
    elgg_extend_view('css/admin', 'roles/css');
    

//agregar librerias
    $lib = elgg_get_plugins_path() . 'roles/lib/lib_roles.php';
    elgg_register_library('roles', $lib);
    elgg_load_library('roles');


//El enrutador
//elgg_register_page_handler('roles', 'roles_handler');
    elgg_register_page_handler('roles', 'roles_handler');

//agregar item al menu principal
//Agregar Item al menu de la página

    if (elgg_is_admin_logged_in()) {

        elgg_register_menu_item('page', array(
            'name' => 'registro_roles',
            'href' => 'roles/registrar',
            'text' => 'Crear Rol',
            'context' => 'admin',
            'priority' => 10,
            'section' => 'Roles'
        ));
        elgg_register_menu_item('page', array(
            'name' => 'listar_roles',
            'href' => 'roles/',
            'text' => 'Listar Roles',
            'context' => 'admin',
            'priority' => 10,
            'section' => 'Roles'
        ));
        elgg_register_menu_item('page', array(
            'name' => 'asignar_roles',
            'href' => 'roles/asignar',
            'text' => 'Asignar Roles',
            'context' => 'admin',
            'priority' => 10,
            'section' => 'Roles'
        ));
    }
}

function roles_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'roles/pages/roles';

    switch ($page[0]) {
        case 'registrar':
            require "$base_path/register.php";
            break;
        case '':
            require "$base_path/list.php";
            break;
        case 'asignar':
            require "$base_path/asignar.php";
            break;
        case 'ver':
            set_input("id", $page[1]);
            require "$base_path/view_user.php";
            break;
        default:
            echo 'no funciona';
            break;
    }
}
