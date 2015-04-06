<?php

$id_asesoria= get_input('id_asesoria');
$name = get_input('nombre');
$tipo = get_input('tipo');
$modo = get_input('modo');
$observaciones = get_input('observaciones');
$fecha = get_input('fecha');
$hora = get_input('hora');
$minutos = get_input('minutos');

$asesoria = new ElggAsesoria($id_asesoria);
$asesoria->title = $name;
$asesoria->fecha = $fecha;
$asesoria->hora = $hora.":".$minutos;
$asesoria->tipo = $tipo;
$asesoria->modo = $modo;
$asesoria->observaciones = $observaciones;

if(!$asesoria->save()){
    register_error(elgg_echo('edit:asesoria:error'));
}else{
    system_message(elgg_echo('edit:asesoria:ok'));
}
forward(REFERER);
