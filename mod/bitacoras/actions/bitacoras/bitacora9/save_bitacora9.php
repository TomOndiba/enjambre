<?php

/**
 * Action que almacena la informacion de diligenciada de la bitacora 9
 * @author DIEGOX_CORTEX
 */
$bitacora = new Elgg_Bitacora9(get_input('bitacora'));

$bitacora->comunidades = get_input('comunidades');
$bitacora->caracteristicas = get_input('caracteristicas');
$bitacora->organizacion = get_input('organizacion');

if($bitacora->save()){
    system_message('Se ha almacenado con éxito...', 'success');
}else{
    register_error('No se ha completado la acción, intentelo de nuevo...');
}

forward(REFERER);

