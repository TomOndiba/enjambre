<?php

/**
 * Page que prepara las variables y redireccina al formulario "edit_nivel" para editar el nivel de feria
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");

$id = get_input('id');
$nivel = new ElggNivelFeria($id);

$title = $area->title;
$content = elgg_view_title($title);
$url1= elgg_get_site_url()."action/nivel_feria/edit?id=".$area->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$params = array ('ide'=>$nivel->guid, 'nombre'=>$nivel->title, 'edit'=>$url_editar); 
$content.= elgg_view_form('nivel_feria/edit_nivel', NULL,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());