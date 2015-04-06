<?php

/**
 * Page que prepara los datos y redirecciona al formulario para
 * administrar la informacion de la bitacora 7
 * @author DIEGOX_CORTEX
 */
$investigacion = get_entity(get_input('id_inv'));
$grupo = get_entity(get_input('id_group'));
$bitacora = elgg_get_relationship($investigacion, 'tiene_la_bitacora_7')[0]->guid;
$institucion = elgg_get_relationship($grupo, "pertenece_a");
$asesor = elgg_get_relationship_inversa($investigacion, 'es_asesor_de');
if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora7();
    $guid = $bit_x->save();
    //agrego la relacion de la bitacroa con la inv
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_7', $guid);
} else {
    $bitacora_x = new Elgg_Bitacora7($bitacora);
   
    $info_bit = array('archivo' => $bitacora_x->archivo, 'aspectos' => $bitacora_x->aspectos, 'capacidades' => $bitacora_x->capacidades,
        'cambios' => $bitacora_x->cambios, 'caracteristicas' => $bitacora_x->caracteristicas, 'guid_bit' => $bitacora_x->guid);
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

$form_vars = array('enctype' => 'multipart/form-data');
$content = elgg_view_form('bitacoras/bitacora7/bitacora7', $form_vars, $vars);
echo $content;

