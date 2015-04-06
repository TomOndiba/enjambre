<?php
elgg_load_css("coordinacion");
elgg_load_js("vincular-evaluadores");

$title = "Vincular Evaluadores";

$guid_convocatoria = get_input('guid');
$params=array("guid_convocatoria"=> $guid_convocatoria);
$content = elgg_view('evaluadores_conv/vincular_evaluadores', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());