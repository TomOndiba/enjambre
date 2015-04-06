<?php

/**
 * Page que prepara los datos y redirecciona para el formulario 
 * de crear la botacora5
 * @author DIEGOX_CORTEX
 */

$invest = $vars['investigacion'];
$grupo = get_entity($vars['grupo']);
$investigacion = get_entity($invest);
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_5')[0]->guid;
$institucion = elgg_get_relationship($grupo, "pertenece_a");


if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora5();
    $guid = $bit_x->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_5', $guid);
} else {
    $bit_5 = new Elgg_Bitacora5($bitacora);
    //Cargo la informacion de los totales que hay registrados
    $info_totales = array('total_totalAp' => $bit_5->total_totalAp, 'total_totalDs' => $bit_5->total_totalDs, 'total_ejecutado' => $bit_5->total_ejecutado, 'total_saldo' => $bit_5->total_saldo);
}

$guid_bit = '';
if (empty($bitacora)) {
    $guid_bit = $guid;
} else {
    $guid_bit = $bitacora;
}
//Obtengo la bitacora 
$bit4 = elgg_get_relationship($investigacion, 'tiene_la_bitacora_4');
//obtengo las actividades relacionadas a la botacora
$actividades_bit4 = elgg_get_actividades_bitacora($bit4[0]->guid);

$i = 1;

foreach ($actividades_bit4 as $ac) {
    //creo los trayectos de la bitacora No5, dependiendo del numero de actividades
    //definidas en la bitacora 4
    
    if (!elgg_existe_trayecto_actividad($ac->guid)) {        
        
        $trayecto = new Elgg_Trayecto();
        $trayecto->nombre = "SEGMENTO O TRAYECTO No. " . sizeof($actividades_bit4);
        $trayecto->owner_guid = $guid_bit;
        $trayecto->container_guid = $ac->guid;
        $guid_t = $trayecto->save();
    }
    
    $i++;
}

$vars = array('id_inv' => $investigacion->guid,
    'owner_inv' => $investigacion->owner_guid,
    'id_group' => $grupo->guid,
    'bit' => $guid_bit,
    'nombre_institucion' => $institucion[0]->name,
    'municipio' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo->name,
    'linea_inv' => get_entity($investigacion->linea_tematica)->name,
    'info_trayectos' => cargar_tabla_items_trayecto_bit5($bitacora, $investigacion->owner_guid, $invest, $grupo->guid),
    'info_totales' => $info_totales);

$content = elgg_view_form('bitacoras/bitacora5/bitacora5', array(), $vars);
echo $content;


