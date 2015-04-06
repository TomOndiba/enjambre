<?php
elgg_load_css('logged');

$guid_grupo=  get_input('id_grupo');
$guid_cuad=  get_input('id_cuad');
$tipo= get_input('tipo');

$maestros=  elgg_listar_maestros_cuaderno($guid_cuad, $tipo);


$grupo = new ElggGrupoInvestigacion($guid_grupo);
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


$params['id_cuad'] = $guid_cuad;
$params['id_grupo'] = $guid_grupo;
$params['integrantes'] = $integrantes;



$params = array ('id_grupo'=>$guid_grupo,'id_cuad'=>$guid_cuad, 'maestros'=>$maestros);

$content=elgg_view('cuaderno_campo/cuadro_busqueda_maestro', $params);  

$content.= elgg_view_form('cuaderno_campo/lista_maestros', NULL, $params);

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 
