<?php

elgg_load_css('logged');

$id= get_input('id');
$institucion = new ElggInstitucion($id);

$title = $institucion->name;

$params['entity']=$institucion->guid;
//$content = elgg_view('redes_tematicas/profile/header', $params);
$content.= elgg_view_form('eventos/crear_evento', null,$params);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 

