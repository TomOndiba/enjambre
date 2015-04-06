<?php

elgg_load_css("coordinacion");
$params = array();
$content.= elgg_view('asesores/listar_convocatorias', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "asesores", array());

