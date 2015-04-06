<?php


elgg_load_css('logged');
$id = get_input('id');
$institucion = new ElggInstitucion($id);
$title = $institucion->name;


$content.= elgg_view('instituciones/profile/informacion_institucion', array('institucion'=>$institucion));

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 