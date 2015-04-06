<?php

/**
 * Save que almacena la informacion de la bitacora 4
 */

$investigacion = get_input('id_inv');
$gupo = get_input('id_group');
$bitacora = get_input('bit');

//CAMPOS DEL FORMULARIO
$dificultades = get_input('dificultades', '', false);
$fortalezas = get_input('fortalezas', '', false);
$caracteristicas = get_input('caracteristicas_proceso', '', false);
$importancia = get_input('importancia', '', false);
$preguntas = get_input('preguntas_aspectos', '', false);

$bit_x = new Elgg_Bitacora4($bitacora);
$bit_x->dificultades = $dificultades;
$bit_x->fortalezas = $fortalezas;
$bit_x->caracteristicas_proceso = $caracteristicas;
$bit_x->importancia = $importancia;
$bit_x->preguntas_aspectos = $preguntas;

if($bit_x->save()){
    system_messages("Bitácora fue modificada exitosamente.", "success");
    forward(REFERER);
}else{
    register_error("Error al regsitrar la bitácora.");
    forward(REFERER);
}

