<?php

elgg_load_css("coordinacion");

$title = "Asesores";
$content = elgg_view('asesores/ver_asesores_banco', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());