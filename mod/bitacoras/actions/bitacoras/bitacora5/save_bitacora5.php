<?php

/**
 * Action que permite almacenar la informacion de la bitacora 5
 * @author DIEGOX_CORTEX
 */
$bit = get_input('id_bit');

$trayectos_b5 = elgg_get_trayectos_bitacora5($bit);
foreach ($trayectos_b5 as $tray) {

    $tray->insumos_totalAp = get_input("insumos_totalAp_{$tray->guid}");
    $tray->insumos_totalDs = get_input("insumos_totalDs_{$tray->guid}");
    $tray->insumos_ejecutado = get_input("insumos_ejecutado_{$tray->guid}");
    $tray->insumos_saldo = get_input("insumos_saldo_{$tray->guid}");

    $tray->papeleria_totalAp = get_input("papeleria_totalAp_{$tray->guid}");
    $tray->papeleria_totalDs = get_input("papeleria_totalDs_{$tray->guid}");
    $tray->papeleria_ejecutado = get_input("papeleria_ejecutado_{$tray->guid}");
    $tray->papeleria_saldo = get_input("papeleria_saldo_{$tray->guid}");

    $tray->transporte_totalAp = get_input("transporte_totalAp_{$tray->guid}");
    $tray->transporte_totalDs = get_input("transporte_totalDs_{$tray->guid}");
    $tray->transporte_ejecutado = get_input("transporte_ejecutado_{$tray->guid}");
    $tray->transporte_saldo = get_input("transporte_saldo_{$tray->guid}");

    $tray->correo_totalAp = get_input("correo_totalAp_{$tray->guid}");
    $tray->correo_totalDs = get_input("correo_totalDs_{$tray->guid}");
    $tray->correo_ejecutado = get_input("correo_ejecutado_{$tray->guid}");
    $tray->correo_saldo = get_input("correo_saldo_{$tray->guid}");

    $tray->materiales_totalAp = get_input("materiales_totalAp_{$tray->guid}");
    $tray->materiales_totalDs = get_input("materiales_totalDs_{$tray->guid}");
    $tray->materiales_ejecutado = get_input("materiales_ejecutado_{$tray->guid}");
    $tray->materiales_saldo = get_input("materiales_saldo_{$tray->guid}");

    $tray->refirgerios_totalAp = get_input("refirgerios_totalAp_{$tray->guid}");
    $tray->refirgerios_totalDs = get_input("refirgerios_totalDs_{$tray->guid}");
    $tray->refirgerios_ejecutado = get_input("refirgerios_ejecutado_{$tray->guid}");
    $tray->refirgerios_saldo = get_input("refirgerios_saldo_{$tray->guid}");

    $tray->subtotal_totalAp = get_input("subtotal_totalAp_{$tray->guid}");
    $tray->subtotal_totalDs = get_input("subtotal_totalDs_{$tray->guid}");
    $tray->subtotal_ejecutado = get_input("subtotal_ejecutado_{$tray->guid}");
    $tray->subtotal_saldo = get_input("subtotal_saldo_{$tray->guid}");
    
    $tray->save();
}

$bitacora = new Elgg_Bitacora5($bit);

$bitacora->total_totalAp = get_input("total_totalAp");
$bitacora->total_totalDs = get_input("total_totalDs");
$bitacora->total_ejecutado = get_input("total_ejecutado");
$bitacora->total_saldo = get_input("total_saldo");

if($bitacora->save()){
    system_messages("Informacion registrada.", "success");
}else{
    register_error("No se pudo almacenar la informacion, intentelo de nuevo.");
}


forward(REFERER);
