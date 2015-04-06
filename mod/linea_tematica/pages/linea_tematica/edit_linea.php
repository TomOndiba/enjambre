<?php

/**
 * Page que prepara las variables y redireccina al formulario "edit_linea" para editar Línea Temática
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");


$id = get_input('id');
$linea = new ElggLineaTematica($id);

$url1= elgg_get_site_url()."action/linea_tematica/edit?id=".$lineaa->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$params = array ('ide'=>$linea->guid, 'descripcion'=>$linea->description, 'nombre'=>$linea->name, 'edit'=>$url_editarm, 'tipo'=>$linea->tipo); 
$content.= elgg_view_form('linea_tematica/edit_linea', NULL,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());