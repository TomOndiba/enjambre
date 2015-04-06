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

 
//$content = elgg_view('redes_tematicas/profile/header', $params);
$page= elgg_get_site_url()."redes_tematicas/ver/{$red->guid}";
$parametros=array('guid'=>$id, 'page'=>$page);
$content.= elgg_view('album/ver_albunes', $parametros);

$body = array('izquierda'=>elgg_view('redes_tematicas/profile/menu', array('red'=>$red)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('red'=>$red)); 

