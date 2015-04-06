<?php

elgg_load_js("vincular-evaluadores");
elgg_load_css("coordinacion");
$guid_feria = get_input('guid');

$title = "Evaluadores no aceptados";
$params=array('guid_feria'=>$guid_feria);
$content = elgg_view('evaluadores_feria/vincular_evaluadores_feria', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());