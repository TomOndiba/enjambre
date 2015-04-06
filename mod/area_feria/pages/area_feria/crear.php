<?php

/**
 * Page que prepara las variables y redirecciona al formulario "create" para crear Area de Feria
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");

$user = elgg_get_logged_in_user_entity();
$title = "Voy a Crar una linea";
$params = array('name' => $user->name);
$content = elgg_view_form('area_feria/create', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
