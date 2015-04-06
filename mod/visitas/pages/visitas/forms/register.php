<?php
elgg_load_css("coordinacion");

//elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
$conv_id = get_input("id_conv");
$convocatoria = new ElggConvocatoria($conv_id);

$content .= elgg_view_form('visitas/register',null,array('conv_id'=>$conv_id,));


$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
