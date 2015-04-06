<?php

/**
 * Page que prepara las variables y redirecciona a la vista "ver" que muestra los niveles de feria que hay en el sistema
 * @author DIEGOX_CORTEX
 */
elgg_load_css("coordinacion");

$nivelFer = listar_niveles_feria();
$title = "Voy a listar niveles de feria";

$lista_niveles= Array();
foreach ($nivelFer as $nivel) { 
    $url_detalles= elgg_get_site_url()."nivel/editar/".$nivel->guid;
    
    $url1= elgg_get_site_url()."action/nivel_feria/eliminar?id=".$nivel->guid;
    $url_eliminar= elgg_add_action_tokens_to_url($url1);
    $conv= array('id'=>$nivel->guid, 'nombre'=>$nivel->title, 'href_elim'=>$url_eliminar, 'href_edit'=>$url_detalles);
    array_push($lista_niveles, $conv);
}



$params = array ('lista_niveles'=>$lista_niveles);
$content .= elgg_view('nivel_feria/ver', $params);
$vars = array('content'=>$content);




$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());