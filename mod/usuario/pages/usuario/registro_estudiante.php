<?php
/**
 * Page que redirecciona a registrar usuario
 */

//melany

elgg_load_css("coordinacion");

elgg_load_js('mostrarcampos');

$instituciones= elgg_get_institucion();

$params = array();
$content = elgg_view_form('usuario/register_estudiante', NULL, $params);

$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());




