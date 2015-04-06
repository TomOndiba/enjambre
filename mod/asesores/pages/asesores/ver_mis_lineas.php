<?php

/**
 * Page que reune la infirmacion necesaria para llevar a la vista donde el asesor 
 * administra sus lineas tematicas...
 * @author DIEGOX_CORTEX
 */

$asesor = elgg_get_logged_in_user_entity();
elgg_load_css("coordinacion");

$lineas_as = elgg_get_lineas_asesor($asesor->guid);
$all_lineas = elgg_get_lineas_tematicas();

$lin_asociadadas = array();
foreach ($lineas_as as $l){
    array_push($lin_asociadadas, $l->guid);
}
$lineas = array();
foreach ($all_lineas as $l){
    array_push($lineas, $l->guid);
}

$lineas_sin_asociar = array_diff($lineas, $lin_asociadadas);


$params = array('lineas_sin_as' => $lineas_sin_asociar, 'lineas_as' => $lin_asociadadas);
$content = elgg_view('asesores/ver_lineas', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "asesores", array());

