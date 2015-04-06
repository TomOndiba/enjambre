<?php

elgg_load_css('logged');
$id = get_input('id');
$institucion = new ElggInstitucion($id);

$title = $institucion->name;
$user = elgg_get_logged_in_user_entity();




//$content = elgg_view('redes_tematicas/profile/header', $params);

$parametros = array('guid' => $id);
$form_params = array('enctype' => 'multipart/form-data');
$content.= elgg_view_form('album/crear_album', $form_params, $parametros);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 

