<?php

$guid = get_input('id');
$convocatoria = new ElggConvocatoria($guid);
$name = $convocatoria->name;

$asesoresInscritos = elgg_get_relationship($convocatoria, "aspirante_asesor_convocatoria");


$asesores_asociados = Array();
foreach ($asesoresInscritos as $asesor) {

    $lin = array('id_linea' => $asesor->guid, 'nombre' => $asesor->name);
    array_push($asesores_asociados, $asesor);
}


$params = array('id' => $convocatoria->guid, 'nombre' => $name, 'asesores_asociados' => $asesores_asociados);
$content.= elgg_view('convocatorias/lista_asesores', $params);
$vars = array('content' => $content);
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);
