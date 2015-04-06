<?php

elgg_register_event_handler('init', 'system', 'instituciones_init');

function instituciones_init() {

    //agregar actions
    $action_path = elgg_get_plugins_path() . "instituciones/actions/instituciones";
    elgg_register_action('instituciones/register', "$action_path/save.php", "logged_in");
    elgg_register_action('instituciones/edit', "$action_path/save.php", "logged_in");
    elgg_register_action('instituciones/eliminar', "$action_path/delete.php", "logged_in");

    //agregar librerias
    $lib = elgg_get_plugins_path() . 'instituciones/lib/lib_instituciones.php';
    elgg_register_library('instituciones', $lib);
    elgg_load_library('instituciones');

    elgg_register_entity_url_handler('instituciones', 'all', 'institucion_url');
    elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'institucion_icon_url_override');

    // Register an icon handler for groups
    elgg_register_page_handler('groupicon3', 'institucion_icon_handler');


    //Registrar Vistas en ajax
    elgg_register_ajax_view('instituciones/listar_instituciones');
    elgg_register_ajax_view('instituciones/listar_instituciones_especiales');
    elgg_register_ajax_view('instituciones/calendario/ver_evento');
    elgg_register_ajax_view('instituciones/ver_grupos');
    elgg_register_ajax_view('instituciones/ver_integrantes');

    //Registrar Js
    $url = "mod/instituciones/vendors/municipios.js";
    elgg_register_js('mun-dpto', $url, 'head');

    $url = "mod/instituciones/vendors/ajax_info.js";
    elgg_register_js('ajax_info', $url, 'head');

    $url = "mod/instituciones/vendors/pagination_ajax_instituciones.js";
    elgg_register_js('pagination/instituciones', $url, 'head');
    $url = "mod/instituciones/vendors/pagination_ajax_instituciones_especiales.js";
    elgg_register_js('pagination/instituciones_especiales', $url, 'head');
    

    $url = "mod/instituciones/vendors/pagination_grupos_institucion.js";
    elgg_register_js('pagination/grupos_institucion', $url, 'head');

    $url = "mod/instituciones/vendors/pagination_integrantes.js";
    elgg_register_js('pagination/integrantes', $url, 'head');

    //El enrutador de la página
    elgg_register_page_handler('instituciones', 'instituciones_handler');

    elgg_extend_view('css/elgg', 'instituciones/css/css');
    //Agregar item al menu principal
    elgg_register_menu_item('site', array(
        'name' => 'registro_instituciones',
        'text' => 'Instituciones',
        'href' => 'instituciones/',
            //'context' => array('instituciones'),
    ));

    elgg_register_menu_item('page', array(
        'name' => 'listar_instituciones',
        'text' => 'Listar Instituciones',
        'href' => 'instituciones/',
        'context' => array('instituciones'),
    ));

    elgg_register_menu_item('page', array(
        'name' => 'registro_instituciones',
        'text' => 'Registrar Institucion',
        'href' => 'instituciones/registrar',
        'context' => array('instituciones'),
    ));

    elgg_register_event_handler('pagesetup', 'system', 'add_menu_instituciones');
}

function add_menu_instituciones() {
    if (elgg_is_active_plugin('OhYesTheme')) {
        $OhyesTheme = new OhYesTheme;
        $OhyesTheme->register_menu_item('header', array(
            'url' => elgg_get_site_url() . 'instituciones/',
            'title' => elgg_echo('ohyes:instituciones'),
            'text' => elgg_echo('ohyes:instituciones'),
            'image_class' => 'ohyes-theme-link-blog',
        ));
    }
}

function instituciones_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'instituciones/pages/instituciones';
    switch ($page[0]) {
        case '':
            require "$base_path/listar.php";
            break;
        case 'especiales':
            require "$base_path/listar_especiales.php";
            break;
        case 'registrar':
            require "$base_path/register.php";
            break;

        case 'editar':
            set_input('guid', $page[1]);
            require "$base_path/editar.php";
            break;
        case 'ver':
            ver_institucion_handler($page);
            break;

        case "archivos":
            archivos_institucion_handler($page);
            break;


        case 'discusiones':
            discusiones_institucion_handler($page);
            break;

        case "marcadores":
            marcadores_institucion_handler($page);
            break;
        case "prueba":
            elgg_load_css('logged');
            $content= elgg_view('instituciones/prueba');
            $body = array('content'=>$content);
            echo elgg_view_page($title, $body, "lista", array());
            break;
        default:
            echo 'no funciona';
            break;
    }
}

function institucion_url($entity) {
    $title = elgg_get_friendly_title($entity->name);
    return "instituciones/ver/{$entity->guid}/$title";
}

function institucion_icon_url_override($hook, $type, $returnvalue, $params) {
    /* @var ElggGroup $group */
    $group = $params['entity'];
    $size = $params['size'];

    $icontime = $group->icontime;
    // handle missing metadata (pre 1.7 installations)
    if (null === $icontime) {

        $file = new ElggFile();
        $file->owner_guid = $group->owner_guid;
        $file->setFilename("instituciones/" . $group->guid . "large.jpg");
        $icontime = $file->exists() ? time() : 0;
        create_metadata($group->guid, 'icontime', $icontime, 'integer', $group->owner_guid, ACCESS_PUBLIC);
    }
    if ($icontime) {



        // return thumbnail

        if ($group->getSubtype() == "red_tematica") {
            return "groupicon2/$group->guid/$size/$icontime.jpg";
        } else if ($group->getSubtype() == "institucion") {
            return "groupicon3/$group->guid/$size/$icontime.jpg";
        } else if ($group->getSubtype() == "feria") {
            return "groupicon4/$group->guid/$size/$icontime.jpg";
        } else if ($group->getSubtype() == "grupo_investigacion") {
            return "groupicon/$group->guid/$size/$icontime.jpg";
        }
    }

    return "mod/instituciones/graphics/default{$size}.gif";
}

/**
 * Handle group icons.
 *
 * @param array $page
 * @return void
 */
function institucion_icon_handler($page) {

    // The username should be the file we're getting
    if (isset($page[0])) {
        set_input('group_guid', $page[0]);
    }
    if (isset($page[1])) {
        set_input('size', $page[1]);
    }


    // Include the standard profile index
    $plugin_dir = elgg_get_plugins_path();
    include("$plugin_dir/instituciones/icon.php");
    return true;
}

function archivos_institucion_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/archivos/list.php";
            break;

        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_file', $page[3]);
            require $plugin_path . "instituciones/pages/archivos/view.php";
            break;

        case 'editar':
            set_input('id', $page[1]);
            set_input('guid_file', $page[3]);
            require $plugin_path . "instituciones/pages/archivos/upload.php";
            break;
    }
}

function ver_institucion_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'instituciones/pages/instituciones';
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "$base_path/ver_institucion.php";
            break;

        case "informacion":
            set_input('id', $page[1]);
            require "$base_path/ver_informacion.php";

            break;
        case "fotos":
            fotos_institucion_handler($page);
            break;

        case "calendario":
            calendario_institucion_handler($page);
            break;
        case "integrantes":
            set_input('id', $page[1]);
            require "$base_path/ver_integrantes.php";
            break;
        case 'grupos_investigacion':
            set_input('id', $page[1]);
            require "$base_path/ver_grupos.php";
            break;
    }
}

function calendario_institucion_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/calendario/ver_calendario.php";
            break;
        case "crear_evento":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/calendario/crear_evento.php";
            break;
    }
}

function fotos_institucion_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/fotos/fotos.php";
            break;
        case "crear_album":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/fotos/crear_album.php";
            break;
        default:
            set_input('id', $page[1]);
            set_input('album', $page[3]);
            require "{$plugin_path}instituciones/pages/fotos/album.php";
            break;
    }
}

function discusiones_institucion_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require $plugin_path . "instituciones/pages/discusiones/list.php";
            break;

        case "add":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/discusiones/add.php";
            break;

        case "view":
            set_input('id', $page[1]);
            set_input('guid_dis', $page[3]);
            require "{$plugin_path}instituciones/pages/discusiones/view.php";
            break;

        case "editar":
            set_input('id', $page[1]);
            set_input('guid_dis', $page[3]);
            require "{$plugin_path}instituciones/pages/discusiones/edit.php";
            break;
    }
}

function marcadores_institucion_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/marcadores/list.php";
            break;
        case "add":
            set_input('id', $page[1]);
            require "{$plugin_path}instituciones/pages/marcadores/add.php";
            break;
        case 'view':
            set_input('id', $page[1]);
            set_input('guid_marcador', $page[3]);
            require $plugin_path . "instituciones/pages/marcadores/view.php";
            break;
        case 'editar':
            set_input('id', $page[1]);
            set_input('guid_marcador', $page[3]);
            require $plugin_path . "instituciones/pages/marcadores/add.php";
            break;
    }
}
