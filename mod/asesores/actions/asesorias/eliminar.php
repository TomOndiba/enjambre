<?php

/**
 * Action que elimina una actividad del cronograma de actividades
 * @author DIEGOX_CORTEX
 */

$id = get_input('id');

$actividad = new ElggAsesoria($id);

if($actividad->delete()){
    system_message("Se eliminado con exito.", 'success');
}else{
    register_error("No se ha completado la accion");
}

forward(REFERER);