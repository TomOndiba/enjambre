<?php

/**
 * Page que prepara las variables y redirecciona al formulario "create" para crear Línea Temática
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");
$user = elgg_get_logged_in_user_entity();
$title = "Voy a Crar un Patrocinandor";
$params = array('name' => $user->name);
$form_params = array('enctype' => 'multipart/form-data');
$content = elgg_view_form('patrocinadores/create', $form_params, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
