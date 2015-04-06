<?php


elgg_register_event_handler('init', 'system', 'redes_tematicas_init');
elgg_register_event_handler('init', 'system', 'redes_tematicas_fields_setup', 10000);

function redes_tematicas_init() {


    // register group entities for search
    elgg_register_entity_type('redes_tematicas', '');
    

    $plugin_path = elgg_get_plugins_path();

    $action_path = $plugin_path . "redes_tematicas/actions/redes_tematicas";
    elgg_register_action('redes_tematicas/register', "$action_path/save.php", "logged_in");
    elgg_register_action('redes_tematicas/eliminar', "$action_path/delete.php", "logged_in");
    elgg_register_action('redes_tematicas/editar', "$action_path/editar.php", "logged_in");
    elgg_register_action('redes_tematicas/join', "$action_path/join.php", "logged_in");
    elgg_register_action('redes_tematicas/cancelrequest', "$action_path/cancelrequest.php", "logged_in");
    elgg_register_action('redes_tematicas/miembro_red', "$action_path/miembro_red.php", "logged_in");
    elgg_register_action('redes_tematicas/abandonar_red', "$action_path/abandonar_red.php", "logged_in");
    elgg_register_action('redes_tematicas/enviar_mensaje', "$action_path/enviar_mensaje.php", "logged_in");
    
    #Nuevos Actions
    elgg_register_action("redes_tematicas/asignar_a_investigacion","$action_path/asignar_investigacion.php");
   
 
    $action_path_eventos = $plugin_path . "redes_tematicas/actions/eventos_red";
    elgg_register_action('eventos_red/crear_evento', "$action_path_eventos/crear_evento.php", "logged_in");

    $action_path_file=$plugin_path."redes_tematicas/actions/archivos";
    elgg_register_action('archivos/upload', "$action_path_file/upload.php", "logged_in");
    elgg_register_action('archivos/eliminar', "$action_path_file/delete.php", "logged_in"); 
    
    
    elgg_register_action('discusiones/responder', $plugin_path."groups/actions/discussion/reply/save.php", "logged_in");
     
    elgg_register_entity_url_handler('redes_tematicas', 'all', 'redes_tematicas_url');

    elgg_register_page_handler('redes_tematicas', 'redes_tematicas_handler');
 
    
    elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'redes_tematicas_icon_url_override');
//
//    // Register an icon handler for groups
    elgg_register_page_handler('groupicon2', 'redes_tematicas_icon_handler');


    // Register Ajax view
     
    elgg_register_ajax_view("redes_tematicas/listar_redes");
    elgg_register_ajax_view("archivos/ver_archivos");
    elgg_register_ajax_view("discusiones/ver_discusiones");
    elgg_register_ajax_view("discusiones/responder_discusion");
    elgg_register_ajax_view("discusiones/add_respuesta");
    elgg_register_ajax_view("discusiones/agregar_discusion");
    elgg_register_ajax_view("discusiones/editar_discusion");
    elgg_register_ajax_view("marcadores/ver_marcadores");
    elgg_register_ajax_view("archivos/subir_archivo");
    elgg_register_ajax_view("marcadores/add_marcador");
    elgg_register_ajax_view("redes_tematicas/calendario/ver_evento");
    elgg_register_ajax_view('redes_tematicas/ver_integrantes');
    elgg_register_ajax_view('redes_tematicas/calendario/ver_evento');
    elgg_register_ajax_view('redes_tematicas/calendario/apartar_turno');
    
    $url = "mod/redes_tematicas/vendors/pagination_ajax_redes.js";
    elgg_register_js('pagination/redes', $url, 'head');
    
    $url= "mod/redes_tematicas/vendors/pag_archivos.js";
    elgg_register_js('pagination/archivos', $url, 'head');

    $url= "mod/redes_tematicas/vendors/pag_discusiones.js";
    elgg_register_js('pagination/discusiones', $url, 'head');
  
    $url= "mod/redes_tematicas/vendors/foro.js";
    elgg_register_js('foro', $url, 'head');

    $url= "mod/redes_tematicas/vendors/pag_marcadores.js";
    elgg_register_js('pagination/marcadores', $url, 'head');
    
    $url = "mod/redes_tematicas/vendors/pagination_member.js";
    elgg_register_js('pagination/member', $url, 'head');
    
    //agregar librerias
    $lib = elgg_get_plugins_path() . 'redes_tematicas/lib/';
    elgg_register_library('redes_tematicas', $lib . 'lib_redes_tematicas.php');
    elgg_load_library('redes_tematicas');
    
    
    
    //registrar el menu redes tematicas en el header del tema ohyes
    elgg_register_event_handler('pagesetup', 'system', 'add_menu_redes_tematicas');
}

/**
 * Registra el menu de Redes Tematicas en el header menu del tema Ohyes
 * de acuerdo al rol del usuario 
 */
function add_menu_redes_tematicas() {
    if (elgg_is_logged_in() && isset($_SESSION['roles'])) {
        $roles = $_SESSION['roles'];
        if (in_array('coordinador', $roles)) {
            if (elgg_is_active_plugin('OhYesTheme')) {
                $OhyesTheme = new OhYesTheme;
                $OhyesTheme->register_menu_item('header', array(
                    'url' => elgg_get_site_url() . "redes_tematicas/listar",
                    'title' => elgg_echo('Redes Tematicas'),
                    'text' => elgg_echo('Redes Tematicas'),
                    'image_class' => 'ohyes-theme-link-blog',
                ));
            }
            elgg_register_menu_item('site', array(
                'name' => 'redes',
                'text' => 'Redes Temáticas',
                'href' => 'redes_tematicas/listar',
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
function redes_tematicas_fields_setup() {

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

function redes_tematicas_handler($page, $identifier) {

    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'redes_tematicas/pages/redes_tematicas';
// select page based on first URL segment after /hello/

    if (count($page) == 0) { // rutas como pagina.com/visitas
        $page[0] = 'listar';
    }
    elgg_load_css("redes_tematicas");
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
            ver_red_handler($page);
            break;
        case 'members':
            redes_tematicas_handle_members_page($page[1]);
            break;
        
         case "integrantes":
            set_input("id", $page[1]);
            require $base_path. '/ver_integrantes.php';
            break;
        
        case 'discusiones':
            discusiones_red_handler($page);
            break;
        
        
        case "archivos":
            archivos_red_handler($page);
            break;
      
        case "marcadores":
            marcadores_red_handler($page);
            break;
        case "mensaje":
            set_input("id", $page[1]);
            require "$base_path/enviar_mensaje.php";
            break;
        default:
            echo 'no funciona';
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}

function redes_tematicas_handle_members_page($guid) {

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

function redes_tematicas_url($entity) {
    $title = elgg_get_friendly_title($entity->name);
        
    return "redes_tematicas/ver/{$entity->guid}/$title";
}

function  redes_tematicas_icon_url_override($hook, $type, $returnvalue, $params) {
    /* @var ElggGroup $group */
    $group = $params['entity'];
    $size = $params['size'];
    $icontime = $group->icontime;
    // handle missing metadata (pre 1.7 installations)
    if (null === $icontime) {

        $file = new ElggFile();
        $file->owner_guid = $group->owner_guid;
        $file->setFilename("redes_tematicas/" . $group->guid . "large.jpg");
        $icontime = $file->exists() ? time() : 0;
        create_metadata($group->guid, 'icontime', $icontime, 'integer', $group->owner_guid, ACCESS_PUBLIC);
    }
    
    if ($icontime) {
         
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

    return "mod/redes_tematicas/graphics/default{$size}.gif";
}

/**
 * Handle group icons.
 *
 * @param array $page
 * @return void
 */
function redes_tematicas_icon_handler($page) {

  
    // The username should be the file we're getting
    if (isset($page[0])) {
        set_input('group_guid', $page[0]);
    }
    if (isset($page[1])) {
        set_input('size', $page[1]);
    }
    // Include the standard profile index
    $plugin_dir = elgg_get_plugins_path();
    include("$plugin_dir/redes_tematicas/icon.php");
    return true;
}


function ver_red_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'redes_tematicas/pages/redes_tematicas';
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "$base_path/ver_red.php";
            break;
        
        case "informacion":
            set_input('id', $page[1]);
            require "$base_path/ver_informacion.php";
            break;
        
        case "fotos":
            fotos_redes_tematicas_handler($page);
            break;
        
        case "calendario":
            calendario_red_handler($page);
            break;
        
    }
}


function calendario_red_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}redes_tematicas/pages/calendario/ver_calendario.php";
            break;
        case "crear_evento":
            set_input('id', $page[1]);
            require "{$plugin_path}redes_tematicas/pages/calendario/crear_evento.php";
            break;
    }
}


function archivos_red_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}redes_tematicas/pages/archivos/list.php";
            break;
        
        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_file',$page[3]);
            require $plugin_path."redes_tematicas/pages/archivos/view.php";
            break;
        
        case 'editar':
            set_input('id', $page[1]);
            set_input('guid_file',$page[3]);
            require $plugin_path."redes_tematicas/pages/archivos/upload.php";
            break;
    }
}

function fotos_redes_tematicas_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[3]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}redes_tematicas/pages/fotos/fotos_red.php";
            break;
        case "crear_album":
            set_input('id',$page[1]);
            require "{$plugin_path}redes_tematicas/pages/fotos/crear_album_red.php";
            break;
        default:
            set_input('id', $page[1]);
            set_input('album', $page[3]);
            require "{$plugin_path}redes_tematicas/pages/fotos/album_red.php";
            break;
    }
}

function discusiones_red_handler($page){
    $plugin_path= elgg_get_plugins_path();
    switch ($page[2]){
       case "":
           set_input('id', $page[1]);
           require $plugin_path."redes_tematicas/pages/discusiones/list.php";
           break;
           
       case "add":
           set_input('id', $page[1]);
           require "{$plugin_path}redes_tematicas/pages/discusiones/add.php";
           break;
       
       case "view":
           set_input('id', $page[1]);
           set_input('guid_dis',$page[3]);
           require "{$plugin_path}redes_tematicas/pages/discusiones/view.php";
           break;
      
        case "editar":
           set_input('id', $page[1]);
           set_input('guid_dis',$page[3]);
           require "{$plugin_path}redes_tematicas/pages/discusiones/edit.php";
           break;
    }
    
}


function marcadores_red_handler($page) {
    $plugin_path = elgg_get_plugins_path();
    switch ($page[2]) {
        case "":
            set_input('id', $page[1]);
            require "{$plugin_path}redes_tematicas/pages/marcadores/list.php";
            break;
        case "add":
            set_input('id', $page[1]);
            require "{$plugin_path}redes_tematicas/pages/marcadores/add.php";
            break;
        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_marcador',$page[3]);
            require $plugin_path."redes_tematicas/pages/marcadores/view.php";
            break;
         case 'editar':
            set_input('guid', $page[1]);
            set_input('guid_marcador',$page[3]);
            require $plugin_path."redes_tematicas/pages/marcadores/add.php";
            break;
    }
}

/**
 * Red activity page
 *
 * @param int $guid Red entity GUID
 */
function groups_handle_activity_page_red($guid) {

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
