<?php

/**
 * Action que registra una actividad asociandola a la bitacora no4
 * @author DIEGOX_CORTEX
 */
$bitacora = get_input('bitacora');
$investigacion = get_input('inv');
$grupo = get_input('grupo');
$act = get_input('act');

$nombre = get_input('nombre');
$desde = get_input('desde');
$hasta = get_input('hasta');
$responsable = get_input('responsable');
if (!empty($nombre) && !empty($desde) && !empty($hasta) && !empty($responsable)) {
    if(empty($act)){
        $actividad = new Elgg_Actividad();
    }else{
        $actividad = new Elgg_Actividad($act);
    }

    $actividad->nombre = $nombre;
    $actividad->fecha_desde = $desde;
    $actividad->fecha_hasta = $hasta;
    $actividad->responsable = $responsable;
    $actividad->owner_guid = $bitacora;

    $guid = $actividad->save();
    
    if ($guid) {
        if (empty($act)) {
            add_entity_relationship($bitacora, 'tiene_actividad', $guid);
            
            system_messages("Se ha añadido una actividad al cronograma.", "success");
        } else {
            system_messages("Se ha editado la actividad.", "success");
        }
    } else {
        register_error("No se pudo relizar la accion intente de nuevo");
    }
}
$actividades = elgg_get_actividades_bitacora($bitacora);
$act = array();

foreach ($actividades as $actividad) {

    $ax = array('nombre' => $actividad->nombre, 'desde' => $actividad->fecha_desde,
        'hasta' => $actividad->fecha_hasta, 'responsable' => $actividad->responsable, 'guid'=> $actividad->guid);

    array_push($act, $ax);
}


// IMPRIMO EL FORMULARIO DE ADMINISTRAR CONOGRAMA
        $vars = array('id_inv' => $investigacion, 'owner_inv' => get_entity($investigacion)->owner_guid, 'id_group' => $grupo, 'bit' => $bitacora, 'actividades' => $act);

        $content = elgg_view_form('bitacoras/bitacora4/admin_cronograma', array(), $vars);
        echo $content;