<?php

$id_conv = get_input('id_conv');
$id_inv = get_input('id_inv');
$name = get_input('nombre');
$tipo = get_input('tipo');
$modo = get_input('modo');
$observaciones = get_input('observaciones');

$fecha = get_input('fecha');
$hora = get_input('hora');
$minutos = get_input('minutos');

$asesoria = new ElggAsesoria();
$asesoria->title = $name;
$asesoria->fecha = $fecha;
$asesoria->hora = $hora.":".$minutos;
$asesoria->tipo = $tipo;
$asesoria->modo = $modo;
$asesoria->observaciones = $observaciones;
$asesoria->container_guid = $id_inv;



$guid = $asesoria->save();

if(!$guid){
    register_error(elgg_echo('no guardo'));
}else{
    $asesoria->addRelationship($id_conv, 'pertenece');
    system_message(elgg_echo('Guardo'));
}
forward(REFERER);
