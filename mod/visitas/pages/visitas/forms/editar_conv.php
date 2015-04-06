<?php

elgg_load_css("coordinacion");
//elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
$conv_id = get_input("id_conv");
$id_visita= get_input("id_visita");

$convocatoria = new ElggConvocatoria($conv_id);
//elgg_push_breadcrumb($convocatoria->name,"convocatorias/detalles/{$conv_id}");
//elgg_push_breadcrumb(elgg_echo('visitas:realizadas:title'),"visitas/listar/{$conv_id}");
//elgg_push_breadcrumb(elgg_echo('visitas:editar:text'),"visitas/editar/{$conv_id}/{$id_visita}");
$title = 'visitas | editar';
$content .= elgg_view_form('visitas/editar_conv',null,array('conv_id'=>$conv_id,'id_visita'=>$id_visita));
//$vars = array('content' => $content);
//$body = elgg_view_layout('one_sidebar', $vars);
//echo elgg_view_page($title, $body);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());