<?php

elgg_load_css('logged');
$idGrupo = get_input('id');
$institucion = new ElggInstitucion($idGrupo);
$title = $institucion->name;
$user = elgg_get_logged_in_user_entity();
$params['title'] = $title;
$params['institucion'] = array(
    'nombre' => $institucion->name,
    'guid' => $institucion->guid,
    'descripcion'=>$institucion->description,
);

$content.= elgg_view('instituciones/profile/contenido_institucion', $params);
$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 
