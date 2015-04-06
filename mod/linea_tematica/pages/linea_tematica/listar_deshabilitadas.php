<?php

/**
 * Page que prepara las variables y redirecciona a la vista "ver" que muestra las Líneas Temáticas que hay en el sistema
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");
$lista_lineas= Array();
$params = array ('lista_lineas'=>$lista_lineas);
$content .= elgg_view('linea_tematica/ver_deshabilitadas', $params);
$vars = array('content'=>$content);

elgg_register_menu_item('title', array(
	'name' => 'create',
	'text' => elgg_echo('linea:create'),
	'href' => elgg_get_site_url().'linea/crear',
	'link_class' => 'link-button',
));

$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
