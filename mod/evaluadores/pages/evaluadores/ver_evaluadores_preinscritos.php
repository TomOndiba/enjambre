<?php

/* 
 * Page que permite listar los maestros que hacen parte de la red de evaluadores y los que enviaron la solicitud para formar parte de la red
 */

elgg_load_css("coordinacion");
$option = array(
    'type' => 'group',
    'subtype' => 'RedEvaluadores',
    'name' => 'evaluadores',
);
$red_evaluadores = elgg_get_entities($option);

$params = array('guid'=>$red_evaluadores[0]);
$content.= elgg_view('evaluadores/ver_evaluadores_preinscritos', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());