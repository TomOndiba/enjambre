<?php

elgg_load_css("coordinacion");
$params= array();
$content = elgg_view('administracion/listado_grupos_inactivos', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
