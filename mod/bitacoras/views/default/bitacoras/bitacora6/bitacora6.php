<?php

/**
 * Page que permite reunir los datos necesarios para crear la bitacora 4
 * @author DIEGOX_CORTEX
 */
$investigacion = $vars['investigacion'];
$grupo = $vars['grupo'];
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_6')[0]->guid;
$bitacora_guid = $bitacora;
if (empty($bitacora)) {
    //Creo una nueva bitacora 6 y la asocio a la investigacion
    $bitacora = new Elgg_Bitacora6();
    $guid = $bitacora->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_6', $guid);
    $bitacora_guid = $guid;
}
$vars = array('inv' => $investigacion, 'grupo' => $grupo, 'guid_bitacora' => $bitacora_guid);
$content = elgg_view_form('bitacoras/bitacora6/bitacora6', array(), $vars);
echo $content;
