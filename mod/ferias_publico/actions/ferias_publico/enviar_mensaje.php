<?php

$guid = get_input('guid');
$asunto = get_input('asunto');
$mensaje = get_input('mensaje');


$red = get_entity($guid);
$miembros = elgg_get_relationship_inversa($red, "es_miembro_de");


foreach ($miembros as $miembro) {
    if (!empty($miembro->email)) {
        elgg_send_email("comunidadenjambre@gmail.com", $miembro->email, $asunto, $mensaje);
    }
}

system_message(elgg_echo('feria:mensaje:send:ok', 'success'));
