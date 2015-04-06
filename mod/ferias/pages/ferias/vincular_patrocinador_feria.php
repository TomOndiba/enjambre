<?php

/* 
 * Page que prepara la informacion y redirecciona a la vista de "vincular_patrocinador_feria".
 */
elgg_load_css("coordinacion");

$guid=  get_input('id');

$feria = new ElggFeria($guid);
elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
elgg_push_breadcrumb($feria->name,"ferias/asociar/{$guid}");
$title = $feria->name;

//Cargo los patrocinadores que pertenecen a la feria
$patrocinadores = elgg_get_patrocinador_de_feria($guid);
$patro = array();
foreach ($patrocinadores as $p){    
    $url2 = elgg_get_site_url() . "action/ferias/desvincular_patrocinadores_feria?id=" . $p->guid."&guid=".$guid;
    $url_desasociarP = elgg_add_action_tokens_to_url($url2);
    $patroX = array('nombre' => $p->title, 'guid' => $p->guid, 'href' => $url_desasociarP, 'logo' => $p->logo);
    array_push($patro, $patroX);
}

$adm_patro = elgg_get_site_url()."patrocinadores/";



$params = array ('id'=>$guid,'nombre'=>$feria->name, 'descripcion'=>$feria->descripcion, 'objetivos'=>$feria->objetivos,
                'correos_contacto'=>$feria->correos_contacto, 'fecha_inicio_feria'=>$feria->fecha_inicio_feria,
                'patro' => $patro, '$adm_patro' => $adm_patro);
$content.= elgg_view('ferias/vincular_patrocinador_feria', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
