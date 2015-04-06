<?php

/**
 * Action que realiza la activacion de un integrande de grupo de investigacion nuevamente
 * @author DIEGOX_CORTEX
 */

$guid = get_input('id');



$result = enable_entity($guid);

if ($result) {
	system_message(elgg_echo('Se ha Activado correctamente'));
} else {
	register_error(elgg_echo('No se pudo Activar'));
}
forward(REFERER);