<?php

/**
 * Action que elimina el grupo de Investigacion
 */

$id=get_input('id'); // id del grupo

$red= new ElggRedTematica($id);

$result = $red->delete(); // elimina el grupo

if ($result) {
	system_message(elgg_echo('feria:ok:delete'));
        
} else {
     
	register_error(elgg_echo('feria:error:delete'));
}

forward("/redes_tematicas/listar/");

