<?php

elgg_load_css("coordinacion");
$guid_conv=  get_input('id_conv');

$params = array ('guid_conv'=>$guid_conv);
$content= elgg_view('investigaciones_asignadas/ver_investigaciones', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "evaluadores", array());

