<?php

elgg_register_event_handler('init', 'system', 'grupo_investigacion_init');
elgg_register_event_handler('init', 'system', 'grupo_investigacion_fields_setup', 10000);

function grupo_investigacion_init() {


    // register group entities for search
    elgg_register_entity_type('grupo_investigacion', '');

    $plugin_path = elgg_get_plugins_path();

    $action_path = $plugin_path . "grupo_investigacion/actions/grupo_investigacion";
    elgg_register_action('grupo_investigacion/register', "$action_path/save.php", "logged_in");
    elgg_register_action('grupo_investigacion/editar', "$action_path/editar.php", "logged_in");
    elgg_register_action('grupo_investigacion/eliminar', "$action_path/delete.php", "logged_in");
    elgg_register_action('grupo_investigacion/join', "$action_path/join.php", "logged_in");
    elgg_register_action('grupo_investigacion/cancelrequest', "$action_path/cancelrequest.php", "logged_in");
    elgg_register_action('grupo_investigacion/miembro_grupo', "$action_path/miembro_grupo.php", "logged_in");
    elgg_register_action('grupo_investigacion/abandonar_grupo', "$action_path/abandonar_grupo.php", "logged_in");
    elgg_register_action('grupo_investigacion/desactivar_integrante', "$action_path/desactivar_integrante.php", "logged_in");
    elgg_register_action('grupo_investigacion/activar_integrante', "$action_path/activar_integrante.php", "logged_in");
    elgg_register_action('grupo_investigacion/desactivar_grupo', "$action_path/desactivar_grupo.php", "logged_in");
    elgg_register_action('grupo_investigacion/activar_grupo', "$action_path/activar_grupo.php", "logged_in");
    elgg_register_action('grupo_investigacion/enviarMensaje', "$action_path/enviar_mensaje.php", "logged_in");
    
    $action_path1 = $plugin_path . "grupo_investigacion/actions/cuaderno_campo";
    elgg_register_action('cuaderno_campo/crear', "$action_path1/crear_cuaderno_campo.php", "logged_in");
    elgg_register_action('cuaderno_campo/eliminar', "$action_path1/delete_cuaderno.php", "logged_in");
    elgg_register_action('cuaderno_campo/eliminar_integrante', "$action_path1/delete_integrante_cuaderno.php", "logged_in");
    elgg_register_action('cuaderno_campo/lista_integrantes', "$action_path1/agregar_integrantes.php", "logged_in");
    elgg_register_action('cuaderno_campo/lista_maestros', "$action_path1/agregar_maestros.php", "logged_in");
 

    $action_path2 = $plugin_path . "grupo_investigacion/actions/investigacion";
    elgg_register_action('investigacion/crear_investigacion', "$action_path2/crear_investigacion.php", "logged_in");
    elgg_register_action('investigacion/convocatorias_abiertas', "$action_path2/inscribir_a_convocatoria.php", "logged_in");
    elgg_register_action('investigacion/definir_categoria', "$action_path2/definir_categoria_inv.php", "logged_in");


    $action_path_profile = $plugin_path . "grupo_investigacion/actions/profile";
    elgg_register_action('profile/add_image', "{$action_path_profile}/upload_img_messageboard.php", "logged_in");
    $action_path_eventos = $plugin_path . "grupo_investigacion/actions/eventos";
    elgg_register_action('eventos/crear_evento', "$action_path_eventos/crear_evento.php", "logged_in");
    elgg_register_action('eventos/crear_evento_1', "$action_path_eventos/crear_evento.php", "logged_in");
    elgg_register_action('eventos/eliminar_evento', "$action_path_eventos/eliminar_evento.php", "logged_in");

    elgg_register_entity_url_handler('grupo_investigacion', 'all', 'grupo_investigacion_url');

    elgg_register_page_handler('grupo_investigacion', 'grupo_investigacion_handler');
    
    elgg_register_ajax_view('grupo_investigacion/roles/lista_select');
    elgg_register_ajax_view('grupo_investigacion/roles/asignar_rol_grupo');
    elgg_register_ajax_view('grupo_investigacion/listarGrupos');
    elgg_register_ajax_view('messageboard/ver_publicaciones_muro');
    elgg_register_ajax_view('messageboard/add_comment');
    elgg_register_ajax_view('messageboard/add');
    elgg_register_ajax_view('sockets/client');
    elgg_register_ajax_view('sockets/server');
    elgg_register_ajax_view('messageboard/eliminar');
    elgg_register_ajax_view('cuaderno_campo/listarCuadernos');
    elgg_register_ajax_view('cuaderno_campo/mostrar_integrantes');
    elgg_register_ajax_view('cuaderno_campo/mostrar_maestros');
    elgg_register_ajax_view('cuaderno_campo/crear_cuaderno');
    elgg_register_ajax_view('grupo_investigacion/calendario/ver_evento');
    elgg_register_ajax_view('investigacion/lineas_convocatoria');
    elgg_register_ajax_view('investigacion/lineas_convocatoria_tipo');
    elgg_register_ajax_view('investigacion/listarInvestigaciones');
    elgg_register_ajax_view('investigacion/inscripcion_feria');
    elgg_register_ajax_view('grupo_investigacion/calendario/crear_evento');
    elgg_register_ajax_view('grupo_investigacion/calendario/crear_evento_1');
    elgg_register_ajax_view('grupo_investigacion/integrantes/ver_integrantes');
    elgg_register_ajax_view('buajaja');

    elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'groups_investigacion_icon_url_override');

    // Register an icon handler for groups
    elgg_register_page_handler('groupicon', 'groups_investigacion_icon_handler');


    $url = "mod/grupo_investigacion/vendors/administrar-roles.js";
    elgg_register_js('admin-grupo/roles', $url, 'head');
    elgg_extend_view('js/elgg', 'grupo_investigacion/roles/js');

    $url = "mod/grupo_investigacion/vendors/pagination_ajax.js";
    elgg_register_js('pagination/grupos', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/vista_modal.js";
    elgg_register_js('vista_modal', $url, 'head');
    elgg_extend_view('js/elgg', 'grupo_investigacion/js');

    $url = "mod/grupo_investigacion/vendors/pagination_ajax_cuaderno.js";
    elgg_register_js('pagination/cuadernos', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/pagination_ajax_investigacion.js";
    elgg_register_js('pag_investigaciones', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/ver_mas_paginado.js";
    elgg_register_js('ver_mas', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/js/resize/autoresize.js";
    elgg_register_js('autoresize', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/pagination_miembros.js";
    elgg_register_js('pagination/miembros', $url, 'head');
    
    $url = "mod/grupo_investigacion/vendors/acciones_investigacion.js";
    elgg_register_js('acciones_investigacion', $url, 'head');
    elgg_extend_view('js/elgg', 'grupo_investigacion/js');

    //Agregar Item al menu de la página
    elgg_register_menu_item('page', array(
        'name' => 'registar Grupo',
        'text' => 'Registrar Grupo de Investigación',
        'href' => 'grupo_investigacion/registrar',
    ));

    //Agregar Item al menu de la página
    elgg_register_menu_item('page', array(
        'name' => 'administrar',
        'text' => 'Administrar Grupo de Investigación',
        'href' => 'grupo_investigacion/administrar',
    ));


    //Agrega js
    $url = "mod/grupo_investigacion/vendors/fullcalendar/fullcalendar.js";
    elgg_register_js('fullcalendar', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/fullcalendar/gacl.js";
    elgg_register_js('gcal', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/calendario.js";
    elgg_register_js('calendario', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/acciones.js";
    elgg_register_js('acciones', $url, 'head');
    
    $url = "mod/grupo_investigacion/vendors/buscar_integrantes.js";
    elgg_register_js('buscar_integrantes', $url, 'head');

    $url = "mod/grupo_investigacion/vendors/buscar_maestros.js";
    elgg_extend_view('js/elgg', 'grupo_investigacion/js');
    elgg_register_js('buscar_maestros', $url, 'head');
    elgg_extend_view('js/elgg', 'grupo_investigacion/js');

    // $url = "mod/convocatorias/vendors/jquery-ui.css";
    // elgg_register_css('jquery-ui', $url, 'footer');
    //elgg_register_simplecache_view('css/grupos');
    //$ohyescss = elgg_get_simplecache_url('css', 'css/grupos');
    $url = "mod/grupo_investigacion/vendors/css/grupos.css";
    elgg_register_css('grupos', $url);
    $url = "mod/grupo_investigacion/vendors/css/fullcalendar.css";
    elgg_register_css('fullcalendar_css', $url);
    //elgg_register_css('grupos.css', $ohyescss, 1);

    if (elgg_is_logged_in()) {

        elgg_register_menu_item('site', array(
            'name' => 'listar',
            'text' => 'Grupos de Investigación',
            'href' => 'grupo_investigacion/listar',
        ));


        //Agregar Item al menu de la página
        elgg_register_menu_item('page', array(
            'name' => 'administrar',
            'text' => 'Administrar Grupo de Investigación',
            'href' => 'grupo_investigacion/administrar',
        ));
    }
    //Agrega js
    //agregar librerias
    $lib = elgg_get_plugins_path() . 'grupo_investigacion/lib/';
    elgg_register_library('grupo_investigacion', $lib . 'lib_grupo_investigacion.php');
    elgg_register_library('lib_imagenes', $lib . 'lib_imagenes.php');
    elgg_load_library('lib_imagenes');
    elgg_load_library('grupo_investigacion');
}

/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function grupo_investigacion_fields_setup() {

    $profile_defaults = array(
        'description' => 'longtext',
        'briefdescription' => 'text',
        'interests' => 'tags',
            //'website' => 'url',
    );

    $profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'group', NULL, $profile_defaults);

    elgg_set_config('group', $profile_defaults);

    // register any tag metadata names
    foreach ($profile_defaults as $name => $type) {
        if ($type == 'tags') {
            elgg_register_tag_metadata_name($name);

            // only shows up in search but why not just set this in en.php as doing it here
            // means you cannot override it in a plugin
            add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("groups:$name")));
        }
    }
}

function grupo_investigacion_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'grupo_investigacion/pages/grupo_investigacion';
// select page based on first URL segment after /hello/

    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = 'listar';
    }
    elgg_load_css("grupos_investigacion");
    switch ($page[0]) {        
        case 'registrar':
            require "$base_path/register.php";
            break;
        case 'administrar':
            require "$base_path/administrar.php";
            break;
        case 'editar':
            set_input("id", $page[1]);
            require "$base_path/editar.php";
            break;
        case '':
        case 'listar':
            require "$base_path/listar.php";
            break;

        case 'join':
            set_input("id", $page[1]);
            set_input("nombre", $page[2]);
            $url = $plugin_path . 'grupo_investigacion/actions/grupo_investigacion/join.php';
            require "$url";
            break;
        case 'solicitudes':
            set_input("id", $page[1]);
            require "$base_path/listar_solicitudes.php";
            break;
        case 'administrar_roles':
            set_input('id', $page[1]);
            require "$base_path/administrar_roles.php";
            break;
        case 'mensaje':
            set_input("id", $page[1]);
            require $base_path . '/enviar_mensaje.php';
            break;
        case 'prueba':
            echo elgg_view('grupo_investigacion/prueba');
            break;
        case 'ver':
            ver_handler($page);
            break;
        case 'members':
            groups_investigacion_handle_members_page($page[1]);
            break;
        case 'ver_cuadernos':
            set_input("id", $page[1]);
            require $plugin_path . 'grupo_investigacion/pages/cuaderno_campo/ver_cuadernos_grupo.php';
            break;
        case 'crear_cuaderno':
            set_input("id", $page[1]);
            require $plugin_path . 'grupo_investigacion/pages/cuaderno_campo/crear_cuaderno_campo.php';
            break;
        case 'ver_cuaderno':
            set_input("id", $page[1]);
            set_input("id_cuaderno", $page[2]);
            require $plugin_path . 'grupo_investigacion/pages/cuaderno_campo/ver_cuaderno.php';
            break;
        case 'buscar_integrantes':
            set_input("id_grupo", $page[1]);
            set_input("id_cuad", $page[2]);
            set_input("tipo", $page[3]);
            require $plugin_path . 'grupo_investigacion/pages/cuaderno_campo/lista_buscar_integrantes.php';
            break;
        case 'buscar_maestros':
            set_input("id_grupo", $page[1]);
            set_input("id_cuad", $page[2]);
            require $plugin_path . 'grupo_investigacion/pages/cuaderno_campo/lista_buscar_maestros.php';
            break;
        case 'ver_convocatorias_abiertas':
            set_input("id_grupo", $page[1]);
            set_input("id_investigacion", $page[2]);
            require $plugin_path . 'grupo_investigacion/pages/investigacion/ver_convocatorias_abiertas.php';
            break;
        case 'ver_ferias_abiertas':
            set_input("id_grupo", $page[1]);
            set_input("id_investigacion", $page[2]);
            require $plugin_path . 'grupo_investigacion/pages/investigacion/ver_ferias_abiertas.php';
            break;
        case "integrantes":
            set_input("id", $page[1]);
            require $plugin_path . 'grupo_investigacion/pages/integrantes/ver_integrantes.php';
            break;
        case "archivos":
            archivos_grupo_handler($page);
            break;
        case 'discusiones':
            discusiones_grupo_handler($page);
            break;
        case 'marcadores':
            marcadores_grupo_handler($page);
            break;
        case 'integrantes_desactivados':
            set_input("id", $page[1]);
            require $plugin_path . 'grupo_investigacion/pages/integrantes/integrantes_desactivados.php';
            break;
        
        default:
            echo 'no funciona';
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}

function groups_investigacion_handle_members_page($guid) {

    elgg_set_page_owner_guid($guid);

    $group = get_entity($guid);
    if (!$group || !elgg_instanceof($group, 'group')) {
        forward();
    }

    group_gatekeeper();

    $title = elgg_echo('groups:members:title', array($group->name));

    elgg_push_breadcrumb($group->name, $group->getURL);
    elgg_push_breadcrumb(elgg_echo('groups:miembros'));

    $content = elgg_list_entities_from_relationship(array(
        'relationship' => 'es_miembro_de',
        'relationship_guid' => $group->guid,
        'inverse_relationship' => true,
        'type' => 'user',
        'limit' => 20,
    ));
    $content.= elgg_list_entities_from_relationship(array(
        'relationship' => 'editar',
        'relationship_guid' => $group->guid,
        'inverse_relationship' => true,
        'type' => 'user',
        'limit' => 20,
    ));

    $params = array(
        'content' => $content,
        'title' => $title,
        'filter' => '',
    );
    $body = elgg_view_layout('content', $params);

    echo elgg_view_page($title, $body);
}

function grupo_investigacion_url($entity) {
    $title = elgg_get_friendly_title($entity->name);
    return "grupo_investigacion/ver/{$entity->guid}/$title";
}

function groups_investigacion_icon_url_override($hook, $type, $returnvalue, $params) {
    /* @var ElggGroup $group */
    $group = $params['entity'];
    $size = $params['size'];

    $icontime = $group->icontime;
    // handle missing metadata (pre 1.7 installations)
    if (null === $icontime) {

        $file = new ElggFile();
        $file->owner_guid = $group->owner_guid;
        $file->setFilename("grupo_investigacion/" . $group->guid . "large.jpg");
        $icontime = $file->exists() ? time() : 0;
        create_metadata($group->guid, 'icontime', $icontime, 'integer', $group->owner_guid, ACCESS_PUBLIC);
    }
    if ($icontime) {
        
        // return thumbnail
      
        if($group->getSubtype()=="red_tematica"){
        return "groupicon2/$group->guid/$size/$icontime.jpg";
        }
        else if($group->getSubtype()=="institucion"){
        return "groupicon3/$group->guid/$size/$icontime.jpg";
        }
        else if($group->getSubtype()=="feria"){
          return "groupicon4/$group->guid/$size/$icontime.jpg";  
        }
        else if($group->getSubtype()=="grupo_investigacion"){
         return "groupicon/$group->guid/$size/$icontime.jpg";   
        }
    }

    return "mod/grupo_investigacion/graphics/default{$size}.gif";
}

/**
 * Handle group icons.
 *
 * @param array $page
 * @return void
 */
function groups_investigacion_icon_handler($page) {
  
    // The username should be the file we're getting
    if (isset($page[0])) {
        set_input('group_guid', $page[0]);
    }
    if (isset($page[1])) {
        set_input('size', $page[1]);
    }
    // Include the standard profile index
    $plugin_dir = elgg_get_plugins_path();
    include("$plugin_dir/grupo_investigacion/icon.php");
    return true;
}

function ver_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'grupo_investigacion/pages/grupo_investigacion';
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "$base_path/ver_grupo.php";
            break;
        case "informacion":
            set_input('id', $page[1]);
            require "$base_path/ver_informacion.php";
            break;
        case "cuadernos":
            cuadernos_handler($page);
            break;
        case "calendario":
            calendario_handler($page);
            break;
        case "investigaciones":
            investigaciones_grupo_handler($page);
            break;
        case "fotos":
            fotos_handler($page);
            break;
        case "diario_campo":
            set_input("id", $page[1]);
            set_input('id_cuaderno', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/diario_campo/ver_diario.php";
            break; 
        case "cuaderno_nota":
            set_input('id', $page[1]);
            set_input('id_cuaderno', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/cuaderno_nota/ver_cuaderno.php";
            break;
        case 'bitacoras':
            bitacoras_grupo_handler($page);
            break;
    }
}

function cuadernos_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input("id", $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/cuaderno_campo/ver_cuadernos_grupo.php";
            break;
//        case "crear":
//            set_input("id", $page[1]);
//            require $plugin_path . 'grupo_investigacion/pages/cuaderno_campo/crear_cuaderno_campo.php';
//            break;
        default:
            set_input("id", $page[1]);
            set_input("id_cuaderno", $page[3]);
            require $plugin_path . "grupo_investigacion/pages/cuaderno_campo/ver_cuaderno.php";
            break;
    }
}

function calendario_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/calendario/ver_calendario.php";
            break;
        case "crear_evento":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/calendario/crear_evento.php";
            break;
    }
}

function bitacoras_grupo_handler($page) {    
   $base_dir = elgg_get_plugins_path() . 'bitacoras_iniciativas/pages/bitacoras_iniciativas';
   switch ($page[3]) {
        case 'editar':
            set_input('id_grupo', $page[1]);
            set_input('tipo', $page[4]);
            set_input('id_bitacora', $page[5]);
            require "{$base_dir}/editar_bitacora.php";
            break;
        case 'ver':
            set_input('id_grupo', $page[1]);
            set_input('tipo', $page[4]);
            set_input('id_bitacora', $page[5]);
            require "{$base_dir}/ver_bitacora.php";
            break;
        
   }
}

function fotos_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/fotos/fotos_grupo_investigacion.php";
            break;
        case "crear_album":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/fotos/crear_album_grupo_investigacion.php";
            break;
        default:
            set_input('id', $page[1]);
            set_input('album', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/fotos/album_grupo_investigacion.php";
            break;
    }
}

function investigaciones_grupo_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input("id", $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/investigacion/ver_investigaciones_grupo.php";
            break;
        default:
            set_input("id_grupo", $page[1]);
            set_input("id_investigacion", $page[3]);
            require $plugin_path . "grupo_investigacion/pages/investigacion/ver_investigacion.php";
            break;
    }
}

function archivos_grupo_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/archivos/list.php";
            break;

        case "autoformacion":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/archivos/autoformacion.php";
            break;

        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_file', $page[3]);
            require $plugin_path . "grupo_investigacion/pages/archivos/view.php";
            break;
        case 'editar':
            set_input('id', $page[1]);
            set_input('guid_file', $page[3]);
            require $plugin_path . "grupo_investigacion/pages/archivos/upload.php";
            break;
    }
}

function discusiones_grupo_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require $plugin_path . "grupo_investigacion/pages/discusiones/list.php";
            break;

        case "add":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/discusiones/add.php";
            break;

        case "view":
            set_input('id', $page[1]);
            set_input('guid_dis', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/discusiones/view.php";
            break;

        case "editar":
            set_input('id', $page[1]);
            set_input('guid_dis', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/discusiones/edit.php";
            break;
    }
}

function marcadores_grupo_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require $plugin_path . "grupo_investigacion/pages/marcadores/list.php";
            break;

        case "add":
            set_input('id', $page[1]);
            require "{$plugin_path}grupo_investigacion/pages/marcadores/add.php";
            break;

        case "view":
            set_input('id', $page[1]);
            set_input('guid_marcador', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/marcadores/view.php";
            break;

        case "editar":
            set_input('id', $page[1]);
            set_input('guid_marcador', $page[3]);
            require "{$plugin_path}grupo_investigacion/pages/marcadores/add.php";
            break;
    }
}
