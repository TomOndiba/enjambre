<?php

/**
 * Page que prepara las variables y redireccina al formulario "edit_area" para editar el Area de Feria
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");

$id = get_input('id');
$area = new ElggAreaFeria($id);


$url1= elgg_get_site_url()."action/area_feria/edit?id=".$area->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$params = array ('ide'=>$area->guid, 'nombre'=>$area->title, 'edit'=>$url_editar); 
$content.= elgg_view_form('area_feria/edit_area', NULL,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());