<?php
elgg_load_css("coordinacion");

$title = "Convocar Asesores";
$params=array("id"=>  get_input("guid_convocatoria"));
$content= elgg_view('asesores/convocar_asesores', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());