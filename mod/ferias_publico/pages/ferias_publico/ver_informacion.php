<?php

elgg_load_css('logged');
$id = get_input('id');
$feria = new ElggFeria($id);
$title = $feria->name;
$user = elgg_get_logged_in_user_entity();

$params['title'] = $title;
$params['guid'] = $feria->guid;

$content.= elgg_view('ferias_publico/profile/informacion_feria', $params);

$body = array('izquierda'=>elgg_view('ferias_publico/profile/menu', array('feria'=>$feria)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('feria'=>$feria)); 
