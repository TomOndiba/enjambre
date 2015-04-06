<?php

/**
 * Page que prepara los datos y redirecciona a la vista para administrar las 
 * actividades del cronograma en la bitacora 4
 * @author DIEGOX_CORTEX
 */

$investigacion = get_input('id_inv');
$grupo = get_input('id_group');
$bitacora = get_input('bit');

if (!empty($bitacora)) {
    
    $actividades = elgg_get_relationship(get_entity($bitacora), 'tiene_actividad');
    $act = array();
   
    foreach ($actividades as $actividad) {
        
        $ax = array('guid' => $actividad->guid,'nombre' => $actividad->nombre, 'desde' => $actividad->fecha_desde, 
                    'hasta' => $actividad->fecha_hasta, 'responsable' => $actividad->responsable);
        
       array_push($act, $ax);
    }
}


elgg_load_css('logged');

$guid_bit = '';
if (empty($bitacora)) {
    $guid_bit = $guid;
} else {
    $guid_bit = $bitacora;
}

$vars = array('id_inv' => $investigacion, 'id_group' => $grupo, 'bit' => $guid_bit, 'actividades' => $act);

$content = elgg_view_form('bitacoras/bitacora4/admin_cronograma', array(), $vars);

$grup = new ElggGrupoInvestigacion($grupo);
$body = array('izquierda' => elgg_view('grupo_investigacion/profile/menu', array('grupo' => $grup)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('grupo' => $grup));
