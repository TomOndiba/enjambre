<?php

/**
 * Action que elimina una Línea Temática
 * @author DIEGOX_CORTEX
 */
$user_guid = elgg_get_logged_in_user_entity();
$id = get_input("id");

$patrocinador = new ElggPatrocinador($id);
$image = new TidypicsImage($patrocinador->logo);

$result = $patrocinador->delete(); // elimina el patrocinador
//$result_img = $image->delete();
if ($result) {
	system_message(elgg_echo('patrocinadores:ok:delete'), 'success');
} else {
	register_error(elgg_echo('patrocinadores:error:delete'), 'error');
}

forward("/patrocinadores/");