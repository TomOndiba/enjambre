<?php

$fecha = get_input('fecha');
$hora_inicio = get_input('hora_inicio');
$hora_fin = get_input('hora_fin');
$asesoria = new ElggAsesoriaRed();
$asesoria->fecha = $fecha;
$asesoria->hora_inicio = $hora_inicio;
$asesoria->hora_fin = $hora_fin;
$asesoria->owner_guid = get_input('red');
elgg_set_ignore_access();
$asesoria->container_guid = elgg_get_logged_in_user_guid();
$duracion = get_input('duracion');
$turnos = array();
for ($i = $hora_inicio; $i <= $hora_fin + 1; $i++) {
    if ($duracion == 15) {
        $turnos[] = array('inv' => 'n', 'hora' => "$i:00");
        $turnos[] = array('inv' => 'n', 'hora' => "$i:15");
        $turnos[] = array('inv' => 'n', 'hora' => "$i:30");
        $turnos[] = array('inv' => 'n', 'hora' => "$i:40");
    }
}
$asesoria->turno = json_encode($turnos);
if($asesoria->save()){
    system_message("Su horario de asesoria se registro correctamente.");
}else {
    register_error("Ha ocurrido un error registrando el horario de asesoria.");
}
