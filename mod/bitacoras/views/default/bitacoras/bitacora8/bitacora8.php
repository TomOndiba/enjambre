<?php

/**
 * Page que prepara los datos y redirecciona al formulario para
 * administrar la informacion de la bitacora 8
 * @author DIEGOX_CORTEX
 */

$investigacion = $vars['investigacion'];
$grupo =  $vars['grupo'];
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_8')[0]->guid;
$bitacora_guid = $bitacora;
if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora8();
    $guid = $bit_x->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_8', $guid);
    $bitacora_guid = $guid;
}
$vars = array('inv' => $investigacion, 'grupo' => $grupo, 'guid_bitacora' => $bitacora_guid);
$form_vars = array('enctype' => 'multipart/form-data');
$content = elgg_view_form('bitacoras/bitacora8/bitacora8', $form_vars, $vars);
echo $content;