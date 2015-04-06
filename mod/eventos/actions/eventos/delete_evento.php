<?php

$id_evento=  get_input('id_evento');
$id_convocatoria=get_input('id_conv');

$evento= new ElggEvento($id_evento);

$result = $evento->delete();

if ($result) {
	system_message(elgg_echo('evento:ok:delete'));
} else {
	register_error(elgg_echo('evento:error:delete'));
}

forward("/eventos/listado/$id_convocatoria");
