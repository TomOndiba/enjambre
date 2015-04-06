<?php

/**
 * Action que almacena la informacion editada en el formulario para un rubro de la
 * bitcora 5.2
 * @author DIEGOX_CORTEX
 */

$bit = get_input('bit');
$rub = get_input('rub');



if(empty($rub)){
    $rubro = new Elgg_Rubro_5_2();
}else{
    $rubro = new Elgg_Rubro_5_2($rub);
}

$rubro->nombre = get_input('nombre');
$rubro->fecha_gasto = get_input('fecha_gasto');
$rubro->proveedor = get_input('proveedor');
$rubro->valor_unitario = get_input('valor_unitario');
$rubro->valor_total = get_input('valor_total');
$rubro->owner_guid = $bit;

$guid = $rubro->save();

if($guid){
    if(empty($rub)){
        system_message("Se ha registrado un nuevo Rubro.", 'success');
    }
    
}else{
    register_error("No se pudo realizar la accion, verifique de nuevo.");
}

forward(REFERER);

