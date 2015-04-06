<?php

/**
 * Page que prepara las variables y redireccina al formulario "edit_patrocinadores" para editar Línea Temática
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");
$id = get_input('id');
$patro = new ElggPatrocinador($id);

$title = $patro->title;
$url1= elgg_get_site_url()."action/patrocinadores/edit?id=".$patro->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$form_params = array('enctype' => 'multipart/form-data');
$params = array ('ide'=>$patro->guid, 'nombre'=>$title, 'edit'=>$url_editarm, 'logo'=>$patro->logo); 
$content.= elgg_view_form('patrocinadores/edit_patrocinadores', $form_params,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());