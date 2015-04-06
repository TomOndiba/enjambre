<?php

/**
 * Page que prepara las variables y redirecciona a la vista "ver" que muestra las subcategorías de innovación que hay en el sistema
 */
elgg_load_css("coordinacion");

$subcategoriaInn = listar_subcategorias_innovacion();
$title = "Subcategorías de Innovación";
elgg_push_breadcrumb(elgg_echo('subcategorias:menu:title'), 'subcategorias/');
$lista_subcategorias= Array();
foreach ($subcategoriaInn as $subcategoria) { 
    $url_detalles= elgg_get_site_url()."subcategorias/editar/".$subcategoria->guid;
    
    $url1= elgg_get_site_url()."action/subcategorias_innovacion/eliminar?id=".$subcategoria->guid;
    $url_eliminar= elgg_add_action_tokens_to_url($url1);
    $conv= array('id'=>$subcategoria->guid, 'nombre'=>$subcategoria->title, 'href_elim'=>$url_eliminar, 'href_edit'=>$url_detalles);
    array_push($lista_subcategorias, $conv);
}

$params = array ('lista_subcategorias'=>$lista_subcategorias);
$content .= elgg_view('subcategorias_innovacion/ver', $params);
$vars = array('content'=>$content);

elgg_register_menu_item('title', array(
	'name' => 'create',
	'text' => elgg_echo('subcategoria:create'),
	'href' => elgg_get_site_url().'subcategorias/crear',
	'link_class' => 'elgg-button elgg-button-action',
));

$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());