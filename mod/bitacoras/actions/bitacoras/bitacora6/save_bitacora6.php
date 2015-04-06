<?php

/**
 * Save que almacena la informacion de la bitacora 4
 */

$bitacora = get_input('bitacora');

//CAMPOS DEL FORMULARIO
$dificultades = get_input('dificultades', '', false);
$fortalezas = get_input('fortalezas', '', false);
$caracteristicas = get_input('caracteristicas', '', false);
$caracteristicas_2 = get_input('caracteristicas_2', '', false);
$logros = get_input('acciones', '', false);
$acciones = get_input('logros', '', false);

$bit_x = new Elgg_Bitacora6($bitacora);
$bit_x->dificultades = $dificultades;
$bit_x->fortalezas = $fortalezas;
$bit_x->caracteristicas = $caracteristicas;
$bit_x->caracteristicas_2 = $caracteristicas_2;
$bit_x->acciones = $acciones;
$bit_x->logros = $logros;

if($bit_x->save()){
    system_messages("Bitácora fue modificada exitosamente.", "success");
    forward(REFERER);
}else{
    register_error("Error al regsitrar la bitácora.");
    forward(REFERER);
}

