<?php

/**
 * Page que prepara las variables y redireccina al formulario "edit_area" para editar la subcategoría
 */
elgg_load_css("coordinacion");

elgg_push_breadcrumb(elgg_echo('subcategorias:menu:title'), 'subcategorias/');
elgg_push_breadcrumb(elgg_echo('Editar subcategoría'), 'subcategorias/editar');
$id = get_input('id');
$subcategoria = new ElggSubcategoria($id);

$title = $subcategoria->title;
$content = elgg_view_title($title);
$url1= elgg_get_site_url()."action/subcategorias/edit?id=".$subcategoria->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$params = array ('ide'=>$subcategoria->guid, 'nombre'=>$title, 'edit'=>$url_editar); 
$content.= elgg_view_form('subcategorias_innovacion/edit_subcategoria', NULL,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());