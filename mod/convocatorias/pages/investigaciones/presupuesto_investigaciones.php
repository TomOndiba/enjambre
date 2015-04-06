<?php
elgg_load_css("coordinacion");

$title = "Presupuesto Investigaciones";
$params=array("guid_convocatoria"=>  get_input("id"));
$content=  elgg_view('investigaciones/seleccionadas/presupuesto', $params);

$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
