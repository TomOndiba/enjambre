<?php

/**
 * Actión que asocia una nueva línea asl asesor...
 * @author DIEGOX_CORTEX
 */

$line = get_input('l');
$asesor = elgg_get_logged_in_user_guid();

if( add_entity_relationship($asesor, "asesor_de_linea", $line)){
    system_messages("Línea asociada...", 'success');
}else{
    register_error("No se ha completado la acción...");
}

forward(REFERER);
        

