<?php

elgg_load_css('logged');


$id= get_input('id');
$grupo = new ElggInstitucion($id);

$title = $grupo->name;
$params['guid']=$grupo->guid;


//$content = elgg_view('grupo_investigacion/profile/header', $params);
 elgg_load_library('elgg:file');


gatekeeper();
group_gatekeeper();

$bookmark_guid = get_input('guid_marcador');
$bookmark = get_entity($bookmark_guid);

// create form

$vars = marcadores_prepare_form_vars($bookmark);
$vars['container_guid']=$grupo->guid;
$content.= elgg_view_form('bookmarks/save', array(), $vars);


$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$grupo)); 
