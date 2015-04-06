<?php

/**
 * Page que prepara los datos y redirecciona al formulario para
 * administrar la informacion de la bitacora 9
 * @author DIEGOX_CORTEX
 */
$investigacion = get_entity(get_input('id_inv'));
$grupo = get_entity(get_input('id_group'));
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_9')[0]->guid;
$institucion = elgg_get_relationship($grupo, "pertenece_a");
$asesor = elgg_get_relationship_inversa($investigacion, 'es_asesor_de');

if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora9();
    $guid = $bit_x->save();
    //agrego la relacion de la bitacroa con la inv
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_9', $guid);
} else {
    $bitacora_x = new Elgg_Bitacora9($bitacora);
    $info_bit = array('comunidades' => $bitacora_x->comunidades, 'caracteristicas' => $bitacora_x->caracteristicas, 'organizacion' => $bitacora_x->organizacion);
}

$docente = get_entity($investigacion->owner_guid);
$inv_nomb = elgg_get_pregunta_investigacion($investigacion->guid);
$vars = array('id_inv' => $investigacion->guid,
    'owner_inv' => $investigacion->owner_guid,
    'id_group' => $grupo->guid,
    'bit' => $bitacora,
    'nombre_institucion' => $institucion[0]->name,
    'municipio' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo->name,
    'nombre_inv' => $investigacion->name,
    'docente' => $docente->name . ' ' . $docente->apellidos,
    'asesor' => $asesor[0]->name . ' ' . $asesor[0]->apellidos,
    'info_bit' => $info_bit);


$content = elgg_view_form('bitacoras/bitacora9/bitacora9', array(), $vars);
echo $content;

