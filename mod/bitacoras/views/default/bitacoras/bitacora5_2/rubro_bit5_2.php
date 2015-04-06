<?php

/**
 * Vista recupera informaicon y redirecciona al formulario para administrar la informacion de un rubro de bitacora 5.2
 * @author DIEGOX_CORTEX
 */

$bit = get_input('bit');
$grupo = get_input('grupo');
$inv = get_input('inv');
$rub = get_input('rub');

if(!empty($rub)){
    $rubro = new Elgg_Rubro_5_2($rub);
    $informacion = array('nombre' => $rubro->nombre, 'fecha_gasto' => $rubro->fecha_gasto, 'proveedor' => $rubro->proveedor,
        'valor_unitario' => $rubro->valor_unitario, 'valor_total' => $rubro->valor_total);
}

$params = array('bit' => $bit, 'grupo' => $grupo, 'inv' => $inv, 'info' => $informacion);
$content = elgg_view_form('bitacoras/bitacora5_2/crear_rubroBit5_2', NULL, $params);
echo $content;

