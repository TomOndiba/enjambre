<?php

/**
 * Page que prepara los datos y redirecciona al formula que gestiona la informacion
 * de la bitacora 5.2
 * @author DIEGOX_CORTEX
 */
$invest = $vars['investigacion'];
$grupo =  $vars['grupo'];
$investigacion=get_entity($invest);
$bit= elgg_get_relationship($investigacion, 'tiene_la_bitacora_5.2')[0]->guid;
$institucion = elgg_get_relationship(get_entity($grupo), "pertenece_a");
$guid_bit = '';
if (empty($bit)) {
    $bitacora5_2 = new Elgg_Bitacora5_2();
    $guid = $bitacora5_2->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_5.2', $guid);
    $guid_bit = $guid;
} else {
    $guid_bit = $bit;
    $bitacora51 = new Elgg_Bitacora5_2($bit);
}

$rubros = elgg_get_rubros_bitacora52($guid_bit);
$info_rubros = array();
foreach ($rubros as $rubro) {    
    $rub_x = array('guid' => $rubro->guid,'nombre' => $rubro->nombre, 'fecha_gasto' => $rubro->fecha_gasto, 'proveedor' => $rubro->proveedor,
        'valor_unitario' => $rubro->valor_unitario, 'valor_total' => $rubro->valor_total);
    array_push($info_rubros, $rub_x);
}
$vars = array('id_inv' => $investigacion->guid,
    'owner_inv' => $investigacion->owner_guid,
    'id_group' => $grupo->guid,
    'bit' => $guid_bit,
    'nombre_institucion' => $institucion[0]->name,
    'municipio' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo->name,
    'linea_inv' => get_entity($investigacion->linea_tematica)->name,
    'info_rubros' => $info_rubros);
$content = elgg_view_form('bitacoras/bitacora5_2/bitacora5_2', array(), $vars);
echo $content;