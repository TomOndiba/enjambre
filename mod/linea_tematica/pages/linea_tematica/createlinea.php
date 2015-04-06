<?php

/**
 * Page que prepara las variables y redirecciona al formulario "ver" para crear Línea Temática
 * @author DIEGOX_CORTEX
 */
$title = "Crear linea";
$user = elgg_get_logged_in_user_entity();
$guid = get_input('id');

$linea = new ElggLineaTematica($guid);

$params = array('nombre' => $linea->name);
$content = elgg_view('linea_tematica/ver', $params);
$vars = array('content' => $content);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);
