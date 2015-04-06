<?php

/**
 * View a marcador
 */
elgg_load_css('logged');

$id = get_input('guid');
$feria = new ElggFeria($id);

$title = $feria->name;
$user = elgg_get_logged_in_user_entity();


$bookmark = get_entity(get_input('guid_marcador'));
$content.= elgg_view('marcadores/ver_marcador', array('entity' => $bookmark));



$body = array('izquierda'=>elgg_view('ferias_publico/profile/menu', array('feria'=>$feria)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('feria'=>$feria)); 
