<?php

elgg_register_event_handler('init', 'system', 'feria_init');
elgg_register_event_handler('init', 'system', 'feria_fields_setup', 10000);

function feria_init() {


    // register group entities for search
    elgg_register_entity_type('feria', '');

    $plugin_path = elgg_get_plugins_path();

    $action_path = $plugin_path . "ferias_publico/actions/ferias_publico";
    elgg_register_action('ferias_publico/register', "$action_path/save.php", "logged_in");
    elgg_register_action('ferias_publico/eliminar', "$action_path/delete.php", "logged_in");
    elgg_register_action('ferias_publico/editar', "$action_path/editar.php", "logged_in");
    elgg_register_action('ferias_publico/join', "$action_path/join.php", "logged_in");
    elgg_register_action('ferias_publico/cancelrequest', "$action_path/cancelrequest.php", "logged_in");
    elgg_register_action('ferias_publico/miembro_red', "$action_path/miembro_red.php", "logged_in");
    elgg_register_action('ferias_publico/abandonar_red', "$action_path/abandonar_red.php", "logged_in");
    elgg_register_action('ferias_publico/enviar_mensaje', "$action_path/enviar_mensaje.php");
   
   
   
    $action_path_eventos = $plugin_path . "ferias_publico/actions/eventos_red";
    elgg_register_action('ferias_publico/crear_evento', "$action_path_eventos/crear_evento.php", "logged_in");

    $action_path_file=$plugin_path."ferias_publico/actions/archivos";
    elgg_register_action('archivos/upload', "$action_path_file/upload.php", "logged_in");
    elgg_register_action('archivos/eliminar', "$action_path_file/delete.php", "logged_in"); 
     
    elgg_register_entity_url_handler('feria', 'all', 'feria_url');

    elgg_register_page_handler('feria', 'feria_handler');
    elgg_register_page_handler('ver_eventos_feria', 'eventos_feria_handler');
 
    
    elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'feria_icon_url_override');
//
//    // Register an icon handler for groups
    elgg_register_page_handler('groupicon4', 'feria_icon_handler');


    // Register Ajax view
    elgg_register_ajax_view("ferias_publico/listar_ferias");
    elgg_register_ajax_view("ferias_publico/calendario/ver_evento");
    
    $url = "mod/ferias_publico/vendors/pagination_ajax_ferias.js";
    elgg_register_js('pagination/feriasp', $url, 'head');
    
    

   
    
//    //agregar librerias
//    $lib = elgg_get_plugins_path() . 'feria/lib/';
//    elgg_register_library('feria', $lib . 'lib_feria.php');
//    elgg_load_library('feria');
//    
    
    
    //registrar el menu redes tematicas en el header del tema ohyes
    elgg_register_event_handler('pagesetup', 'system', 'add_menu_feria');
}

/**
 * Registra el menu de Redes Tematicas en el header menu del tema Ohyes
 * de acuerdo al rol del usuario 
 */
function add_menu_feria() {
    if (elgg_is_logged_in() && isset($_SESSION['roles'])) {
        $roles = $_SESSION['roles'];
        if (in_array('coordinador', $roles)) {
            if (elgg_is_active_plugin('OhYesTheme')) {
                $OhyesTheme = new OhYesTheme;
                $OhyesTheme->register_menu_item('header', array(
                    'url' => elgg_get_site_url() . "feria/listar",
                    'title' => elgg_echo('Feria'),
                    'text' => elgg_echo('Feria'),
                    'image_class' => 'ohyes-theme-link-blog',
                ));
            }
            elgg_register_menu_item('site', array(
                'name' => 'feria',
                'text' => 'Feria',
                'href' => 'feria/listar',
            ));
        }
    }
}





/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function feria_fields_setup() {

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

function feria_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'ferias_publico/pages/ferias_publico';
// select page based on first URL segment after /hello/
    elgg_load_css("ferias");
    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = 'listar';
    }
    
    switch ($page[0]) {
        case 'registrar':
            require "$base_path/register.php";
            break;

        case 'editar':
            set_input("id", $page[1]);
            require "$base_path/editar.php";
            break;

        case '':
        case 'listar':
            require "$base_path/listar.php";
            break;

        
        
        case 'solicitudes':
            set_input("id", $page[1]);
            require "$base_path/listar_solicitudes.php";
            break;
        case 'administrar_roles':
            set_input('id', $page[1]);
            require "$base_path/administrar_roles.php";
            break;
       
        case 'ver':
            ver_feria_handler($page);
            break;
        case 'members':
            feria_handle_members_page($page[1]);
            break;
        
        
        case 'discusiones':
            discusiones_feria_handler($page);
            break;
        
        case 'patrocinadores':
            set_input("id", $page[1]);
            require "$base_path/ver_patrocinadores.php";
            break;
        
        case "archivos":
            archivos_feria_handler($page);
            break;
      
        case "marcadores":
            marcadores_feria_handler($page);
            break;
        case "mensaje":
            set_input("id", $page[1]);
            require "$base_path/enviar_mensaje.php";
            break;
        case 'ver_eventos':
            eventos_feria_handler($page);
            break;
        default:
            echo 'no funciona';
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}

function feria_handle_members_page($guid) {

    elgg_set_page_owner_guid($guid);

    $red = get_entity($guid);
    if (!$red || !elgg_instanceof($red, 'group')) {
        forward();
    }

    group_gatekeeper();

    $title = elgg_echo('groups:members:title', array($red->name));

    elgg_push_breadcrumb($red->name, $red->getURL);
    elgg_push_breadcrumb(elgg_echo('groups:miembros'));

    $content = elgg_list_entities_from_relationship(array(
        'relationship' => 'es_miembro_de',
        'relationship_guid' => $red->guid,
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

function feria_url($entity) {
    $title = elgg_get_friendly_title($entity->name);
    return "feria/ver/{$entity->guid}/$title";
}

function  feria_icon_url_override($hook, $type, $returnvalue, $params) {
    /* @var ElggGroup $group */
    $group = $params['entity'];
    $size = $params['size'];
    $icontime = $group->icontime;
    // handle missing metadata (pre 1.7 installations)
    if (null === $icontime) {

        $file = new ElggFile();
        $file->owner_guid = $group->owner_guid;
        $file->setFilename("ferias_publico/" . $group->guid . "large.jpg");
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

    return "mod/ferias_publico/graphics/default{$size}.gif";
}

/**
 * Handle group icons.
 *
 * @param array $page
 * @return void
 */
function feria_icon_handler($page) {

    // The username should be the file we're getting
    if (isset($page[0])) {
        set_input('group_guid', $page[0]);
    }
    if (isset($page[1])) {
        set_input('size', $page[1]);
    }
    // Include the standard profile index
    $plugin_dir = elgg_get_plugins_path();
    include("$plugin_dir/ferias_publico/icon.php");
    return true;
}


function ver_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'ferias_publico/pages/ferias_publico';
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "$base_path/ver_informacion.php";
            break;
        
        case "muro":
            set_input('id', $page[1]);
            require "$base_path/ver_feria.php";
            break;
        case "fotos":
            fotos_feria_handler($page);
            break;
        
        case "calendario":
            calendario_feria_handler($page);
            break;
        
    }
}


function calendario_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}ferias_publico/pages/calendario/ver_calendario.php";
            break;
        case "crear_evento":
            set_input('id', $page[1]);
            require "{$plugin_path}ferias_publico/pages/calendario/crear_evento.php";
            break;
    }
}


function archivos_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}ferias_publico/pages/archivos/list.php";
            break;
        
        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_file',$page[3]);
            require $plugin_path."ferias_publico/pages/archivos/view.php";
            break;
        
        case 'editar':
            set_input('id', $page[1]);
            set_input('guid_file',$page[3]);
            require $plugin_path."ferias_publico/pages/archivos/upload.php";
            break;
    }
}

function fotos_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}ferias_publico/pages/fotos/fotos_feria.php";
            break;
        case "crear_album":
            set_input('id',$page[1]);
            require "{$plugin_path}ferias_publico/pages/fotos/crear_album_feria.php";
            break;
        default:
            set_input('id', $page[1]);
            set_input('album', $page[3]);
            require "{$plugin_path}ferias_publico/pages/fotos/album_feria.php";
            break;
    }
}

function discusiones_feria_handler($page){
    $plugin_path= elgg_get_plugins_path();
    switch ($page[2]){
       case "":
           set_input('id', $page[1]);
           require $plugin_path."ferias_publico/pages/discusiones/list.php";
           break;
           
       case "add":
           set_input('id', $page[1]);
           require "{$plugin_path}ferias_publico/pages/discusiones/add.php";
           break;
       
       case "view":
           set_input('id', $page[1]);
           set_input('guid_dis',$page[3]);
           require "{$plugin_path}ferias_publico/pages/discusiones/view.php";
           break;
      
        case "editar":
           set_input('id', $page[1]);
           set_input('guid_dis',$page[3]);
           require "{$plugin_path}ferias_publico/pages/discusiones/edit.php";
           break;
    }
    
}


function marcadores_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}ferias_publico/pages/marcadores/list.php";
            break;
        case "add":
            set_input('id', $page[1]);
            require "{$plugin_path}ferias_publico/pages/marcadores/add.php";
            break;
        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_marcador',$page[3]);
            require $plugin_path."ferias_publico/pages/marcadores/view.php";
            break;
         case 'editar':
            set_input('id', $page[1]);
            set_input('guid_marcador',$page[3]);
            require $plugin_path."ferias_publico/pages/marcadores/add.php";
            break;
    }
}

/**
 * Red activity page
 *
 * @param int $guid Red entity GUID
 */
function groups_handle_activity_page_feria($guid) {

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!$group || !elgg_instanceof($group, 'group')) {
		forward();
	}

	group_gatekeeper();

	$title = elgg_echo('groups:activity');

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb($title);

	$db_prefix = elgg_get_config('dbprefix');

	$content = elgg_list_river(array(
		'joins' => array("JOIN {$db_prefix}entities e ON e.guid = rv.object_guid"),
		'wheres' => array("e.container_guid = $guid")
	));
	if (!$content) {
		$content = '<p>' . elgg_echo('groups:activity:none') . '</p>';
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}


function eventos_feria_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'eventos/pages/calendario';
    switch ($page[1]) {
        case "calendario":
            set_input("guid", $page[2]);
            require "{$base_path}/ver_calendario_feria.php";
            break;
    }
}