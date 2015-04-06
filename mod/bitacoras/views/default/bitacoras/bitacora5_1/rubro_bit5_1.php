<?php

/**
 * Vista recupera informaicon y redirecciona al formulario para administrar la informacion de un rubro de bitacora 5.1
 * @author DIEGOX_CORTEX
 */

$bit = get_input('bit');
$grupo = get_input('grupo');
$inv = get_input('inv');
$rub = get_input('rub');

if(!empty($rub)){
    $rubro = new Elgg_Rubro($rub);
    $informacion = array('nombre' => $rubro->nombre, 'descripcion_gasto' => $rubro->descripcion_gasto, 'valor_unit' => $rubro->valor_unit,
        'valor_tot_rub' => $rubro->valor_tot_rub, 'valor_total' => $rubro->valor_total);
}

$params = array('bit' => $bit, 'grupo' => $grupo, 'inv' => $inv, 'info' => $informacion);
$content = elgg_view_form('bitacoras/bitacora5_1/crear_rubroBit5_1', NULL, $params);
echo $content;