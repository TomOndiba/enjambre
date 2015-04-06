<?php
elgg_load_css("coordinacion");


$title = "Vincular Asesores";
$params=array("guid_convocatoria"=>  get_input("guid"));
$content = elgg_view('asesores/vincular_asesores', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());


