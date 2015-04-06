<?php

/**
 * Action que elimina un Área de Feria
 * @author DIEGOX_CORTEX
 */
$user_guid = elgg_get_logged_in_user_entity();
$ar_id = get_input("id");
$ar_nom=  get_input("nombre");

$areaF = new ElggAreaFeria($ar_id);


$result = $areaF->delete(); // elimina el área de feria

if ($result) {
	system_message(elgg_echo('area:ok:delete'), 'success');
} else {
	register_error(elgg_echo('area:error:delete'), 'error');
}

forward("/area/listar");