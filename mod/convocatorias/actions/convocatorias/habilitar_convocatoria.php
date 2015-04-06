<?php

$id_convocatoria=get_input('id');

$convocatoria = get_entity($id_convocatoria);


$result = enable_entity($id_convocatoria);

if ($result) {
	system_message(elgg_echo('convocatoria:ok:enable'));
} else {
	register_error(elgg_echo('convocatoria:error:enable'));
}

forward("/convocatorias/listado/");

