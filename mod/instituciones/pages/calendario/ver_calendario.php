<?php

elgg_load_css('logged');

$id= get_input('id');
$institucion = new ElggInstitucion($id);

$title = $institucion ->name;
$params['institucion'] = array(
    'guid' => $institucion->guid,);

$params['guid']=$institucion->guid;

$content.= elgg_view('grupo_investigacion/calendario/ver_calendario', $params);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion )), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion )); 

