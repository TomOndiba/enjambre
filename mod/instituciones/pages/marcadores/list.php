<?php

elgg_load_css('logged');

$id= get_input('id');
$grupo = new ElggInstitucion($id);

$title = $grupo->name;

$params['guid']=$grupo->guid;

gatekeeper();
group_gatekeeper();

// create form

//$content = elgg_view('grupo_investigacion/profile/header', $params);

$content.= elgg_view('marcadores/ver_marcadores', $params);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$grupo)); 



