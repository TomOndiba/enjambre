<?php

elgg_load_css('logged');

$id= get_input('id');
$feria = new ElggFeria($id);

$title = $feria->name;
$user = elgg_get_logged_in_user_entity();

 $params['guid']=$feria->guid;
 elgg_load_library('elgg:file');


gatekeeper();
group_gatekeeper();

// create form

$bookmark_guid = get_input('guid_marcador');
$bookmark = get_entity($bookmark_guid);

// create form

$vars = marcadores_prepare_form_vars($bookmark);
$vars['container_guid']=$feria->guid;
$content.= elgg_view_form('bookmarks/save', array(), $vars);

$body = array('izquierda'=>elgg_view('ferias_publico/profile/menu', array('feria'=>$feria)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('feria'=>$feria)); 
