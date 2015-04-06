<?php

/**
 * View a file
 *
 * @package ElggFile
 */
elgg_load_css('logged');


$id= get_input('id');
$grupo = new ElggInstitucion($id);

$params['guid']=$grupo->guid;


//$content = elgg_view('grupo_investigacion/profile/header', $params);


$bookmark = get_entity(get_input('guid_marcador'));
$content.= elgg_view('marcadores/ver_marcador', array('entity' => $bookmark));

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$grupo)); 

