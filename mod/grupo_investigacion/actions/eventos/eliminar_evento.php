<?php

$id_evento=  get_input('id_evento');
$evento= new ElggEvento($id_evento);

$result = $evento->delete();

if ($result) {
	system_message(elgg_echo('evento:ok:delete'));
} else {
	register_error(elgg_echo('evento:error:delete'));
}

forward(REFERER);
