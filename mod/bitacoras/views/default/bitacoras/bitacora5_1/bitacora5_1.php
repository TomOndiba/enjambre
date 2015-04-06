<?php

/**
 * Page que prepara los datos y redirecciona al formula que gestiona la informacion
 * de la bitacora 5.1
 * @author DIEGOX_CORTEX
 */

$invest = $vars['investigacion'];
$grupo =  $vars['grupo'];
if(empty($invest) && empty($grupo)){
    $invest = get_input('inv');
    $grupo = get_input('grup');
}

$investigacion=get_entity($invest);
$bit= elgg_get_relationship($investigacion, 'tiene_la_bitacora_5.1')[0]->guid;
$institucion = elgg_get_relationship(get_entity($grupo), "pertenece_a");


$guid_bit = '';
if (empty($bit)) {
    $bitacora5_1 = new Elgg_Bitacora5_1();
    $guid = $bitacora5_1->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_5.1', $guid);
    $guid_bit = $guid;
} else {
    $guid_bit = $bit;
    $bitacora51 = new Elgg_Bitacora5_1($bit);
}

$bit5 = elgg_get_relationship($investigacion, 'tiene_la_bitacora_5');
//$rubros = elgg_get_rubros_bitacora51($guid_bit);



$vars = array('id_inv' => $investigacion->guid,
    'owner_inv' => $investigacion->owner_guid,
    'id_group' => $grupo->guid,
    'bit' => $guid_bit,
    'nombre_institucion' => $institucion[0]->name,
    'municipio' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo->name,
    'linea_inv' => get_entity($investigacion->linea_tematica)->name,    
    'info_rubros' => cargar_tabla_items_trayecto_bit51($bit5[0]->guid, $investigacion->owner_guid, $investigacion->guid));

$content = elgg_view_form('bitacoras/bitacora5_1/bitacora5_1', array(), $vars);
echo $content;

