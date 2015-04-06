<?php

/**
 * Paege que redirecciona a la vista de administracion de las evidencias
 * @author DIEGOX_CORTEX
 */
elgg_load_js('reveal2');
elgg_load_css("reveal");
elgg_load_css("coordinacion");
elgg_load_library('elgg:file');

$asesoria = get_entity(get_input('id_asesoria'));

$title = "Evidencias de Asesorias {$asesoria->title}";
$params = array("id_conv" => get_input("guid_conv"), "id_inv" => get_input("guid_inv"), "id_asesoria" => $asesoria->guid);
$content = elgg_view('asesorias/evidencias_asesoria', $params);
$body = array('content' => $content);

echo elgg_view_page($title, $body, "asesores", array());
