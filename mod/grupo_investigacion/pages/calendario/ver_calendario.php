<?php

elgg_load_css('logged');
elgg_load_js('validate');

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
$params['guid']=$grupo->guid;

$content.= elgg_view('grupo_investigacion/calendario/ver_calendario', $params);

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 

