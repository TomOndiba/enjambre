<?php

/**
 * Action que habilita nuevamente a una feria deshabilitada
 * @author DIEGOX_CORTEX
 */
$feria = get_entity(get_input('id'));



if(enable_entity(get_input('id'))){
    system_messages(elgg_echo("Se ha activado"), 'success');
}else{
    register_error(elgg_echo('No se ha completado la accion'));
}

forward(REFERER);
