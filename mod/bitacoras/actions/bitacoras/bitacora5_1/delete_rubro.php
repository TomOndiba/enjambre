<?php

/**
 * Action que elimina un rubro de la bitacora 5.1
 * @author DIEGOX_CORTEX
 */

$rub = get_input('rub');

$rubro = new Elgg_Rubro($rub);

if($rubro->delete()){
    system_message("Se ha eliminado el rubro.", 'success');
}else{
    register_error('No se pudo completar la acción, intente de nuevo.');
}

forward(REFERER);