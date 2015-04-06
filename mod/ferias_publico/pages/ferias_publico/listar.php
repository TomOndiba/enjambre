<?php

elgg_load_css('logged');
$title = "Listado";
$params = array();
$content = elgg_view('ferias_publico/listar_ferias', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
