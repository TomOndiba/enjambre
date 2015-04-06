<?php
$investigacion = $vars['investigacion'];
$grupo =  $vars['grupo'];
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_9')[0]->guid;
$bitacora_guid = $bitacora;
if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora9();
    $guid = $bit_x->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_9', $guid);
    $bitacora_guid = $guid;
}
$vars = array('inv' => $investigacion, 'grupo' => $grupo, 'guid_bitacora' => $bitacora_guid);
$form_vars = array('enctype' => 'multipart/form-data');
$content = elgg_view_form('bitacoras/bitacora9/bitacora9', $form_vars, $vars);
echo $content;

