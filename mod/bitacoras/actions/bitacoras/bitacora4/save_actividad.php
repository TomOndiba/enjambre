<?php

/**
 * Action que registra una actividad asociandola a la bitacora no4
 * @author DIEGOX_CORTEX
 */
$bitacora = get_input('bit');
$grupo = get_input('grupo');
$investigacion = get_input('inv');
$act = get_input('act');

$nombre = get_input('nombre');
$desde = get_input('desde');
$hasta = get_input('hasta');
$responsable = get_input('responsable');

if (!empty($nombre) && !empty($desde) && !empty($hasta) && !empty($responsable)) {
    $actividad = new Elgg_Actividad($act);

    $actividad->nombre = $nombre;
    $actividad->fecha_desde = $desde;
    $actividad->fecha_hasta = $hasta;
    $actividad->responsable = $responsable;
    $actividad->owner_guid = $bitacora;

    $guid = $actividad->save();

//    if ($guid) {
//        if (empty($act)) {
//            add_entity_relationship($bitacora, 'tiene_actividad', $guid);
//            system_messages("Se ha añadido una actividad al cronograma.", "success");
//        } else {
//            system_messages("Se ha editado la actividad.", "success");
//        }
//    } else {
//        register_error("No se pudo relizar la accion intente de nuevo");
//    }
}
forward(REFERER);
