<?php

/**
 * Action que elimina el grupo de Investigacion
 */

$id=get_input('id'); // id del grupo

$red= new ElggRedTematica($id);

$result = $red->delete(); // elimina el grupo

if ($result) {
	system_message(elgg_echo('red:ok:delete'));
        
} else {
     
	register_error(elgg_echo('red:error:delete'));
}

forward("/redes_tematicas/listar/");

