<?php

/**
 * Action que elimina un Nivel de Feria
 * @author DIEGOX_CORTEX
 */
$user_guid = elgg_get_logged_in_user_entity();
$niv_id = get_input("id");
$niv_nom=  get_input("nombre");

$nivelF = new ElggNivelFeria($niv_id);


$result = $nivelF->delete(); // elimina el área de feria

if ($result) {
	system_message(elgg_echo('nivel:ok:delete'), 'success');
} else {
	register_error(elgg_echo('nivel:error:delete'), 'error');
}

forward("/nivel/listar");