<?php

/**
 * Vista ajax que permite precargar un formualio para crear una actividad del cronograma de actividades
 * @author DIEGOX_CORTEX
 */
$bit = get_input('bit');
$grupo = get_input('grupo');
$inv = get_input('inv');
$act = get_input('act');

if(!empty($act)){
    $actividad = new Elgg_Actividad($act);
    $informacion = array('nombre' => $actividad->nombre, 'desde' => $actividad->fecha_desde, 'hasta' => $actividad->fecha_hasta, 'responsable' => $actividad->responsable);
}

$params = array('bit' => $bit, 'grupo' => $grupo, 'inv' => $inv, 'info' => $informacion);
$content = elgg_view_form('bitacoras/bitacora4/crear_actividadBit4', NULL, $params);
echo $content;
