<?php

$guid=get_input('guid');
$asunto=get_input('asunto');
$mensaje= get_input('mensaje');

$red=  get_entity($guid);
$miembros= elgg_get_relationship_inversa($red, "es_miembro_de");


foreach ($miembros as $miembro){
    
$result = messages_send($asunto, $mensaje, $miembro->guid, 0, $reply);
elgg_send_email("comunidadenjambre@gmail.com", $miembro->email, $asunto, $mensaje);

}