<?php

elgg_load_css("coordinacion");
$params = array();
$content.= elgg_view('evaluadores/listar_convocatorias_evaluador', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "evaluadores", array());

