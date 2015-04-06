<?php


$title = "Generar Acta de Selección";

$guid_convocatoria = get_input('guid');

$params=array("guid_convocatoria"=> $guid_convocatoria);
$content = elgg_view('acta_de_seleccion/acta_de_seleccion', $params);
$vars = array('content' => $content);
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);

