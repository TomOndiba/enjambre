<?php
elgg_load_js('validate');
elgg_load_css('logged');
$idGrupo = get_input('id');
$grupo = new ElggGrupoInvestigacion($idGrupo);
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
    $params['buttons']['unirse']=$solicitud;
} else if ($rol == 'request') {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/cancelrequest?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Cancelar Solicitud');
    $params['buttons']['cancelar']=$solicitud;
    $permiso=false;
} else if ($rol == "admin") {
    $sol = elgg_get_site_url() . "grupo_investigacion/administrar_roles/" . $grupo->guid;
    $array = array('href' => $sol,
        'value' => 'Administar Roles');
    $sol = elgg_get_site_url() . "grupo_investigacion/solicitudes/" . $grupo->guid;
    $array2=array('href' => $sol,
        'value' => 'Solicitudes');
     $params['buttons']['solicitudes']=$sol;
}

if ($rol == "editor" || $rol == "leer") {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/abandonar_grupo?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Abandonar Grupo');
    $params['buttons']['abandonar']=$solicitud;
}
$params['rol_user']=$permiso;
//$content = elgg_view('grupo_investigacion/profile/header', $params);
$content.= elgg_view('grupo_investigacion/profile/contenido_grupo', $params);


$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo,'botones'=>$params['buttons'])), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 

