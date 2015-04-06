<?php

/**
 * Action que elimina una institucion
 * @author Erika Parra
 */

$id = get_input("guid");

$institucion = new ElggInstitucion($id);


$result = $institucion->delete(); // elimina 

if ($result) {
	system_message(elgg_echo('institucion:ok:delete'), 'success');
} else {
	register_error(elgg_echo('institucion:error:delete'), 'error');
}

forward("/instituciones/");