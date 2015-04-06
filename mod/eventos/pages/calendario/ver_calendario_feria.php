<?php

elgg_load_css('logged');

$idEntity = get_input('guid');
$entity = new ElggGroup($idEntity);
$title = $entity->name;
$user = elgg_get_logged_in_user_entity();
$params['title'] = $title;
$params['entity'] = $entity;

$content.= elgg_view('eventos/calendario/ver_calendario', $params);
$body = array('izquierda'=>elgg_view('ferias_publico/profile/menu', array('feria'=>$entity)),  'derecha'=>$content);
//$body=array('content'=>$content);
echo elgg_view_page($title, $body, "profile"); 

