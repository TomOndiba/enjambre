<?php

elgg_load_css('reveal');
elgg_load_css("coordinacion");
$params=array("guid_feria"=>  get_input('id'));
$content = elgg_view('investigaciones_feria/ver_investigaciones', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());