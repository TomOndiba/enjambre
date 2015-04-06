<?php

elgg_load_css('reveal');
elgg_load_css("coordinacion");
$title = "Investigaciones";
$params=array("guid_convocatoria"=>  get_input('guid_conv'));
$content = elgg_view('asesores/investigaciones_asignadas', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "asesores", array());
