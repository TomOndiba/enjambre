<?php

/**
 * Page que prepara las variables y redirecciona a la vista "ver" que muestra las áreas de feria que hay en el sistema
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");

$areaFer = listar_areas_feria();
//$user = elgg_get_logged_in_user_entity();
$title = "Voy a listar áras de feria";
//$params = array('name' => $user->name);

$lista_areas= Array();
foreach ($areaFer as $area) { 
    $url_detalles= elgg_get_site_url()."area/editar/".$area->guid;
    
    $url1= elgg_get_site_url()."action/area_feria/eliminar?id=".$area->guid;
    $url_eliminar= elgg_add_action_tokens_to_url($url1);
    $conv= array('id'=>$area->guid, 'nombre'=>$area->title, 'href_elim'=>$url_eliminar, 'href_edit'=>$url_detalles);
    array_push($lista_areas, $conv);
}



$params = array ('lista_areas'=>$lista_areas);
$content .= elgg_view('area_feria/ver', $params);
$vars = array('content'=>$content);

elgg_register_menu_item('title', array(
	'name' => 'create',
	'text' => elgg_echo('area:create'),
	'href' => elgg_get_site_url().'area/crear',
	'link_class' => 'elgg-button elgg-button-action',
));


$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());