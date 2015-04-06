<?php

elgg_load_css('logged');
$title = "Listado";
$params = array();
$content = elgg_view('redes_tematicas/listar_redes', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
