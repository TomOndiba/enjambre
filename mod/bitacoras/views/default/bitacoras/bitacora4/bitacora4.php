<?php

/**
 * Page que permite reunir los datos necesarios para crear la bitacora 4
 * @author DIEGOX_CORTEX
 */
$investigacion = $vars['investigacion'];
$grupo = $vars['grupo'];
$bitacora= elgg_get_relationship(get_entity($investigacion), 'tiene_la_bitacora_4')[0]->guid;

if (empty($bitacora)) {
    //Creo una nueva bitacora 4 y la asocio a la investigacion
    $bitacora4 = new Elgg_Bitacora4();
    $guid = $bitacora4->save();
    add_entity_relationship($investigacion, 'tiene_la_bitacora_4', $guid);
} else {    
    //busco las actividades del cronograma que tenga asociadas la bitacora
    $actividades = elgg_get_actividades_bitacora($bitacora);
    $act = array();
    
    foreach ($actividades as $actividad) {
         
        $ax = array('nombre' => $actividad->nombre, 'desde' => $actividad->fecha_desde, 
                    'hasta' => $actividad->fecha_hasta, 'responsable' => $actividad->responsable, 'guid' => $actividad->guid);
        
       array_push($act, $ax);
    }
    
    //voy a tomar los datos que ya tiene registrados la bitacora
    $bitacora_x = new Elgg_Bitacora4($bitacora);
    $info_bitac =  array('funciones_integrantes' => $bitacora_x->funciones_integrantes, 'libreta_apuntes' => $bitacora_x->libreta_apuntes,
                         'estudiante_tesorero' => $bitacora_x->estudiante_tesorero, 'indagacion' => $bitacora_x->indagacion,
                         'dificultades' => $bitacora_x->dificultades,
                         'fortalezas' => $bitacora_x->fortalezas, 'caracteristicas' => $bitacora_x->caracteristicas, 
                         'importancia' => $bitacora_x->importancia, 'preguntas' => $bitacora_x->preguntas, 'acompañamiento' => $bitacora_x->acompañamiento);
}
$guid_bit = '';
if (empty($bitacora)) {
    $guid_bit = $guid;
} else {
    $guid_bit = $bitacora;
}

$vars = array('id_inv' => $investigacion, 'owner_inv' => get_entity($investigacion)->owner_guid, 'id_group' => $grupo, 'bit' => $guid_bit, 'actividades' => $act, 'info' => $info_bitac);

$content = elgg_view_form('bitacoras/bitacora4/bitacora4', array(), $vars);
echo $content;
