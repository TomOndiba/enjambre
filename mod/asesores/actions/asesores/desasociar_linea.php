<?php

/**
 * Action que desasocia una línea temática de un asesor
 * @author DIEGOX_CORTEX
 */

$line = get_input('l');
$asesor = elgg_get_logged_in_user_guid();

if(remove_entity_relationship($asesor, 'asesor_de_linea', $line)){
    system_messages("Línea Desasociada...", 'success');
}else{
    register_error("No se ha completado la acción...");
}

forward(REFERER);

