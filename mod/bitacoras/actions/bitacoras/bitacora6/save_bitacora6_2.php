<?php

/**
 * Save que almacena la informacion de la bitacora 4
 */

$bitacora = get_input('bitacora');

//CAMPOS DEL FORMULARIO
$dificultades = get_input('dificultades', '', false);
$fortalezas = get_input('fortalezas', '', false);
$caracteristicas = get_input('caracteristicas', '', false);
$estrategia = get_input('estrategia', '', false);
$logros = get_input('logros', '', false);

$bit_x = new Elgg_Bitacora6_2($bitacora);
$bit_x->dificultades = $dificultades;
$bit_x->fortalezas = $fortalezas;
$bit_x->caracteristicas = $caracteristicas;
$bit_x->estrategia = $estrategia;
$bit_x->logros = $logros;

if($bit_x->save()){
    system_messages("Bitácora fue modificada exitosamente.", "success");
    forward(REFERER);
}else{
    register_error("Error al regsitrar la bitácora.");
    forward(REFERER);
}

