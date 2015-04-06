<?php

/*
  page para agregar discusiones en una red
 * carga la vista de save discussion y envia al action save ubicadas en el plugin Groups
 */
elgg_load_css('logged');
$id = get_input('id');
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
    'descripcion' => $grupo->description,
);


$params['buttons'] = array();
$permiso = $rol;
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
    $permiso = false;
} else if ($rol == "admin") {
    $sol = elgg_get_site_url() . "grupo_investigacion/administrar_roles/" . $grupo->guid;
    $array = array('href' => $sol,
        'value' => 'Administar Roles');
    array_push($params['buttons'], $array);
    $sol = elgg_get_site_url() . "grupo_investigacion/solicitudes/" . $grupo->guid;
    $array2 = array('href' => $sol,
        'value' => 'Solicitudes');
    ;
    array_push($params['buttons'], $array2);
}

if ($rol == "editor" || $rol == "leer") {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/abandonar_grupo?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Abandonar Grupo');
    array_push($params['buttons'], $array);
}
$params['rol_user'] = $permiso;
//$content = elgg_view('grupo_investigacion/profile/header', $params);



$group = get_entity($id);
if (!$group) {
    register_error(elgg_echo('group:notfound'));
    forward();
}

// make sure user has permissions to add a topic to container
if (!$group->canWriteToContainer(0, 'object', 'groupforumtopic')) {
    register_error(elgg_echo('groups:permissions:error'));
    forward($group->getURL());
}

//		$title = elgg_echo('groups:addtopic');
//
//		elgg_push_breadcrumb($group->name, "discussion/owner/$group->guid");
//		elgg_push_breadcrumb($title);

$body_vars = discussiones_prepare_form_vars();
$body_vars['container_guid'] = $grupo->guid;


$content.= elgg_view_form('discussion/save', array(), $body_vars);


$body = array('izquierda' => elgg_view('grupo_investigacion/profile/menu', array('grupo' => $grupo)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('grupo' => $grupo));
