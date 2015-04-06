<?php

/**
 * Page que prepara los datos y redirecciona al formulario para
 * administrar la informacion de la bitacora 7
 * @author DIEGOX_CORTEX
 */
$investigacion = $vars['investigacion'];
$grupo =  $vars['grupo'];
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_7')[0]->guid;
$bitacora_guid = $bitacora;
if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora7();
    $guid = $bit_x->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_7', $guid);
    $bitacora_guid = $guid;
}

$vars = array('inv' => $investigacion, 'grupo' => $grupo, 'guid_bitacora' => $bitacora_guid);
$form_vars = array('enctype' => 'multipart/form-data');
$content = elgg_view_form('bitacoras/bitacora7/bitacora7', $form_vars, $vars);
echo $content;

