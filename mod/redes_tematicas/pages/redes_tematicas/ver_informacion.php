<?php


elgg_load_css('logged');
$id = get_input('id');
$red = new ElggRedTematica($id);
$title = $red->name;


$content.= elgg_view('redes_tematicas/profile/informacion_red', array('red'=>$red));

$body = array('izquierda'=>elgg_view('redes_tematicas/profile/menu', array('red'=>$red)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('red'=>$red)); 