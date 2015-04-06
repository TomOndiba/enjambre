<?php

elgg_load_css("coordinacion");
$title = 'visitas | Registro';
//$content = elgg_view_title('Registro de visitas');
$content .= elgg_view_form('visitas/create');
$vars = array(
    'content' => $content
);

//$body = elgg_view_layout('one_sidebar', $vars);
//echo elgg_view_page($title, $body);
echo elgg_view_page($title, $vars, "coordinacion_one_column", array());

