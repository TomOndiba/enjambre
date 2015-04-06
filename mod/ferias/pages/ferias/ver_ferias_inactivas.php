<?php

elgg_load_css("coordinacion");

elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
$params = array ();
$content.= elgg_view('ferias/listar_ferias_inactivas', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());


