<?php
elgg_load_css("coordinacion");
$title = "Asesores en Convocatoria";
$params = array("convocatoria" => get_input("convocatoria"));
$content = elgg_view('asesores/lista_asesores', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
