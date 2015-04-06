<?php

$hora = get_input("hora");
$red = get_input("red");
$asesoria = get_input('asesoria');
$ase = new ElggAsesoriaRed($asesoria);
$turnos = json_decode($ase->turno, true);
$tur = array();
$msg = "La cita se aparto correctamente.";
foreach ($turnos as $turno) {
    if ($turno['hora'] == $hora) {
        if ($turno['inv'] == "n") {
            error_log($turno['hora']);
            $turno['inv'] = elgg_get_logged_in_user_guid();
        } else {
            $msg = "Error al registrar la cita";
        }
    }
    $tur[] = $turno;
}
$ase->turno = json_encode($tur);
$ase->save();
$investigaciones = elgg_get_entities_from_relationship(array(
        'relationship' => 'pertenece_a_red',
        'relationship_guid'=> $red,
        'inverse_relationship'=>true)); 
$inv = get_input('investigacion');
$tipo = "Online";
$observaciones = get_input('observaciones');
$fecha = $ase->fecha;
$minutos = get_input('minutos');
$asesoria2 = new ElggAsesoria();
$asesoria2->title = "Asesoria Virtual";
$asesoria2->fecha = $fecha;
$asesoria2->hora = $hora;
$asesoria2->tipo = $tipo;
$asesoria2->modo = $tipo;
$asesoria2->container_guid = $inv;
$asesoria2->owner_guid = $asesoria;



$guid = $asesoria2->save();

if(!$guid){
    register_error(elgg_echo('no guardo'));
}else{
    system_message(elgg_echo('Guardo'));
}
forward(REFERER);

echo $msg;
