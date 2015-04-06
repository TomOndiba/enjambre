<?php

elgg_load_css('logged');

$guid_inv = get_input('id_investigacion');
$guid_group = get_input('id_grupo');
$title = get_entity($guid_group)->name;
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);
$grupo = get_entity($guid_group);

$ferias_abiertas = elgg_get_ferias_abiertas();

$optionsFeria = array();
if (sizeof($ferias_abiertas) > 0) {
    $optionsFeria[0] = "Seleccionar..";
    foreach ($ferias_abiertas as $fr) {
        if ($fr->tipo_feria == 'Municipal') {
            $optionsFeria[$fr->guid] = $fr->name;
        }
    }
}

$params['grupo'] = array(
    'nombre' => $grupo->name,
    'guid' => $grupo->guid,
    'rol_user' => $rol,
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

$params['ferias'] = $optionsFeria;
$params['id_investigacion'] = $guid_inv;
$params['title'] = $title;
$params['guid_grupo'] = $guid_group;
$content.= elgg_view_form('investigacion/ferias_abiertas', null, $params);

$body = array('izquierda' => elgg_view('grupo_investigacion/profile/menu', array('grupo' => $grupo)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('grupo' => $grupo));

