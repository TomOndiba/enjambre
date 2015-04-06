<?php

elgg_load_css("coordinacion");
$params= array();
$content = elgg_view('administracion/administrar_inhabilitadas', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());

