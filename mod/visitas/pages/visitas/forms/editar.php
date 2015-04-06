<?php

elgg_load_css("coordinacion");
$id_visita= get_input("id_visita");

$convocatoria = new ElggConvocatoria($conv_id);

$title = 'visitas | editar';
$content .= elgg_view_form('visitas/editar',null,array('conv_id'=>$conv_id,'id_visita'=>$id_visita));

$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());

