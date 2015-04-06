<?php
elgg_load_css("coordinacion");
$title = "Vincular Asesores";
$params = array("convocatoria" => get_input("convocatoria"));
$content = elgg_view('asesores/registrar_asesor', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
