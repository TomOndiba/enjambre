<?php

/**
 * Action que elimina el grupo de Investigacion
 */

$id=get_input('id'); // id del grupo

$grupo= new ElggGrupoInvestigacion($id);

$result = $grupo->delete(); // elimina el grupo

if ($result) {
	system_message(elgg_echo('grupo:ok:delete'));
} else {
	register_error(elgg_echo('grupo:error:delete'));
}

forward("/grupo_investigacion/listar/");

