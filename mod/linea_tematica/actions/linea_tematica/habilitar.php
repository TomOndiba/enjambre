<?php

/**
 * Action que habilita nuevamente una línea temática nuevamente
 * @author DIEGOX_CORTEX
 */

if(enable_entity(get_input('id'))){
    system_messages(elgg_echo("Se ha activado"), 'success');
}else{
    register_error(elgg_echo('No se ha completado la accion'));
}

forward(elgg_get_site_url().'linea');