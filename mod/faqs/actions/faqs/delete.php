<?php

/**
 * Action que elimina una pregunta de FAQ's
 * @author DIEGOX_CORTEX
 */

$entity = get_entity(get_input('id'));

if($entity->delete()){
    system_messages("Se ha eliminado correctamente.", 'success');
}  else {
    register_error('No se ha completado la acción.');
}

forward(REFERER);

