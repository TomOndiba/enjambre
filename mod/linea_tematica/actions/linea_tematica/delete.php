<?php

/**
 * Action que elimina una Línea Temática
 * @author DIEGOX_CORTEX
 */
$user_guid = elgg_get_logged_in_user_entity();
$lin_id = get_input("id");
$lin_nom=  get_input("nombre");

$lineaT = new ElggLineaTematica($lin_id);


$result = $lineaT->disable(); 

if ($result) {
	system_message(elgg_echo('linea:ok:delete'), 'success');
} else {
	register_error(elgg_echo('linea:error:delete'), 'error');
}

forward("/linea/listar");