<?php

/**
 * Action que actualiza la información de una Línea Temáica
 * @author DIEGOX_CORTEX
 */
$name = get_input('nombre');
$descripcion = get_input('descripcion');
$existe_grupo = elgg_existe_linea($name);
$tipo = get_input('tipo');

//if ($existe_grupo) {
//system_messages(elgg_echo('linea:repetido'), 'error');
//} else {

$id = get_input('id');

$linea_tematica = new ElggLineaTematica($id);
$linea_tematica->name = $name;
$linea_tematica->description = $descripcion;

$options = array(
    'guid' => $linea_tematica->guid,
    'metadata_name' => 'tipo',
    'limit' => false
);
$g = elgg_delete_metadata($options);

//$b=create_metadata($linea_tematica->guid, 'tipo', $tipo, 'text', elgg_get_logged_in_user_guid(), ACCESS_PUBLIC);
$b = create_metadata($linea_tematica->guid, 'tipo', $tipo, 'text', $user->guid, ACCESS_PUBLIC);

$guid = $linea_tematica->save();


if ($guid)
    system_messages(elgg_echo('edicion_linea:correcto'), 'success');
else
    register_error(elgg_echo('edicion_linea:invalido'), 'error');
//}

forward("/linea/listar");
