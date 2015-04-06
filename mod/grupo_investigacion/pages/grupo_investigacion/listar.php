<?php
elgg_load_css('logged');
$title = "Listado de Grupos de Investigación";
$params = array();
$content = elgg_view('grupo_investigacion/listarGrupos', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());

