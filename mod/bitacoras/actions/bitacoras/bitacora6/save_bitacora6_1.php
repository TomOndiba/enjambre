<?php

/**
 * Save que almacena la informacion de la bitacora 4
 */

$bitacora = get_input('bitacora');

//CAMPOS DEL FORMULARIO
$tecnicas = get_input('tecnicas', '', false);
$salida = get_input('salida', '', false);
$organizacion = get_input('organizacion', '', false);
$actividades = get_input('actividades', '', false);

$bit_x = new Elgg_Bitacora6_1($bitacora);
$bit_x->tecnicas = $tecnicas;
$bit_x->salida = $salida;
$bit_x->organizacion = $organizacion;
$bit_x->actividades = $actividades;

if($bit_x->save()){
    system_messages("Bitácora fue modificada exitosamente.", "success");
    forward(REFERER);
}else{
    register_error("Error al regsitrar la bitácora.");
    forward(REFERER);
}

