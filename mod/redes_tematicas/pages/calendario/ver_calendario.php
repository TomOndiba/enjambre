<?php

elgg_load_css('logged');

$id= get_input('id');
$red = new ElggRedTematica($id);

$title = $red->name;
$user = elgg_get_logged_in_user_entity();

$params['title'] = $title;
$params['red'] = array(
    'nombre' => $red->name,
    'guid' => $red->guid,
    //'imagen'=>$grupo->getIconURL(),
    'descripcion'=>$red->description,
);


$params['guid']=$red->guid;

$content.= elgg_view('redes_tematicas/calendario/ver_calendario', $params);

$body = array('izquierda'=>elgg_view('redes_tematicas/profile/menu', array('red'=>$red)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('red'=>$red)); 

