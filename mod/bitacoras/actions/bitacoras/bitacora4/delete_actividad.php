<?php

/**
 * Action que permite eliminar una actividad del cronograma de actividades de la bitacora no4
 * @author DIEGOX_CORTEX
 */

$act = get_input('act');

$actividad = new Elgg_Actividad($act);

if($actividad->delete()){
    system_message("Se ha eliminado la actividad.", 'success');
}else{
    register_error('No se pudo completar la accion, intente de nuevo.');
}

forward(REFERER);
