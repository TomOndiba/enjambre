<?php
elgg_load_css('logged');

$id= get_input('id');
$institucion = new ElggInstitucion($id);

$title = $institucion->name;
$user = elgg_get_logged_in_user_entity();

 
//$content = elgg_view('redes_tematicas/profile/header', $params);
$page= elgg_get_site_url()."instituciones/ver/{$institucion->guid}";
$parametros=array('guid'=>$id, 'page'=>$page);
$content.= elgg_view('album/ver_albunes', $parametros);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 

