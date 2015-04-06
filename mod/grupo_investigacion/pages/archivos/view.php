<?php
/**
 * View a file
 *
 * @package ElggFile
 */
/**** Prepara las variables que se muestran en el Header de la Red tematica************/

elgg_load_css('logged');
elgg_load_js('confirmacion');
elgg_load_css('bitacoras');


$id=  get_input('guid');
$grupo = new ElggGrupoInvestigacion($id);

$title = $grupo->name;
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);
$params['title'] = $title;
$params['grupo'] = array(
    'nombre' => $grupo->name,
    'guid' => $grupo->guid,
    'rol_user' => $rol,
    //'imagen'=>$grupo->getIconURL(),
    'descripcion'=>$grupo->description,
);


$params['buttons'] = array();
$permiso=$rol;
if (!$rol && $user) {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/join?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Unirse');
    array_push($params['buttons'], $array);
} else if ($rol == 'request') {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/cancelrequest?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Cancelar Solicitud');
    array_push($params['buttons'], $array);
    $permiso=false;
} else if ($rol == "admin") {
    $sol = elgg_get_site_url() . "grupo_investigacion/administrar_roles/" . $grupo->guid;
    $array = array('href' => $sol,
        'value' => 'Administar Roles');
    array_push($params['buttons'], $array);
    $sol = elgg_get_site_url() . "grupo_investigacion/solicitudes/" . $grupo->guid;
    $array2=array('href' => $sol,
        'value' => 'Solicitudes');;
     array_push($params['buttons'], $array2);
}

if ($rol == "editor" || $rol == "leer") {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/abandonar_grupo?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Abandonar Grupo');
    array_push($params['buttons'], $array);
}
$params['rol_user']=$permiso;

//$content = elgg_view('grupo_investigacion/profile/header', $params);

 


  /***Prepara y llama la vista que muestra el archivo ****/
 elgg_load_library('elgg:file');
 
 
// create form
$form_vars = array('enctype' => 'multipart/form-data');
$body_vars = file_prepare_form_vars();
$body_vars['container_guid']=$grupo->guid;


gatekeeper();
group_gatekeeper();

$file = get_entity(get_input('guid_file'));
if (!$file) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

$owner = elgg_get_page_owner_entity();


$title = $file->title;


$content.= elgg_view('archivos/ver_archivo', array('file' =>$file));

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 