<?php

/* 
 * Page que prepara la informacion y redirecciona a la vista de "vincular_area_nivel_feria".
 */

$guid=  get_input('id');
elgg_load_css("coordinacion");

$feria = new ElggFeria($guid);
elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
elgg_push_breadcrumb($feria->name,"ferias/asociar/{$guid}");
$title = $feria->name;

//Cargo los niveles que pertenecen a la feria
$niveles = elgg_get_nivel_de_feria($guid);
$niv = array();
foreach ($niveles as $n){    
    $url2 = elgg_get_site_url() . "action/ferias/desvincular_area_nivel_feria?id=" . $n->guid."&guid=".$guid;
    $url_desasociarN = elgg_add_action_tokens_to_url($url2);
    $nivelX = array('nombre' => $n->title, 'guid' => $n->guid, 'href' => $url_desasociarN);
    array_push($niv, $nivelX);
}

//Cargo las áreas que pertenecen a la feria
$areas = elgg_get_areas_de_feria($guid);
$are = array();
foreach ($areas as $a){
    $url1 = elgg_get_site_url() . "action/ferias/desvincular_area_nivel_feria?id=" . $a->guid."&guid=".$guid;
    $url_desasociarA = elgg_add_action_tokens_to_url($url1);
    $areaX = array('nombre' => $a->title, 'guid' => $a->guid, 'href' => $url_desasociarA);
    array_push($are, $areaX);
}

$adm_area = elgg_get_site_url()."area/listar";
$adm_nivel = elgg_get_site_url()."nivel/listar";


$params = array ('id'=>$guid, 'tipo_feria'=>$feria->tipo_feria,'nombre'=>$feria->name, 
                'departamento'=>$feria->departamento, 'fecha_apertura'=>$feria->fecha_inicio_feria, 
                'fecha_cierre'=>$feria->fecha_fin_feria, 'fecha_pub_resultados'=>$feria->fecha_pub_resultados,
                'objetivos'=>$feria->objetivos, 'niveles' => $niv, 'areas' => $are, 'adm_area' => $adm_area,
                'adm_nivel' => $adm_nivel);
$content.= elgg_view('ferias/vincular_area_nivel_feria', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());