<?php

/**
 * Page que prepara la informacion y redirecciona a la vista "vista_hoja_vida"
 */

$id_user = get_input('id_user');

elgg_load_css("coordinacion");
$params = array('id_user' => $id_user);
$content = elgg_view('asesores/vista_hoja_de_vida', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());