<?php

/**
 * Page que prepara las variables y redirecciona a la vista "ver" que muestra las Líneas Temáticas que hay en el sistema
 * @author DIEGOX_CORTEX
 */

elgg_load_css("coordinacion");
$lineasPatro = listar_patrocinadores();

$lista_patrocinadores= Array();
foreach ($lineasPatro as $patro) { 
    $url_detalles= elgg_get_site_url()."patrocinadores/editar/".$patro->guid;    
    $url1= elgg_get_site_url()."action/patrocinadores/eliminar?id=".$patro->guid;
    $url_eliminar= elgg_add_action_tokens_to_url($url1);
    $conv= array('guid'=>$patro->guid, 'nombre'=>$patro->title, 'href_elim'=>$url_eliminar, 'logo'=>$patro->logo, 'href_edit'=>$url_detalles);
    array_push($lista_patrocinadores, $conv);
}

$params = array ('lista_patro'=>$lista_patrocinadores);
$content .= elgg_view('patrocinadores/ver', $params);


elgg_register_menu_item('title', array(
	'name' => 'create',
	'text' => elgg_echo('patrocinador:create'),
	'href' => elgg_get_site_url().'patrocinadores/crear',
	'link_class' => 'elgg-button elgg-button-action',
));

$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());