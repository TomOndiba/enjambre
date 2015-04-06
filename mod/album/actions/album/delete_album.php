<?php

/**
 * Action que permite eliminar un album
 */
$album = get_entity(get_input('album'));
$guid_entity_owner=$album->owner_guid;


$options = array('type' => 'object',
    'subtype' => 'image',
    'container_guid' => $album->guid);

$fotos = elgg_get_entities($options);
error_log("No. de fotos: " . sizeof($fotos));

foreach ($fotos as $foto) {

    if ($foto->delete()) {
        error_log("se eliminó la foto " . $foto->id);
    }
}


if ($album->delete()) {
    system_messages("Se ha eliminado el Album", 'success');
} else {
    register_error('No se ha completado la acción.');
}

$entity = get_entity($guid_entity_owner);

if ($entity->getSubtype() == "institucion") {
    forward($site_url . "instituciones/ver/{$entity->guid}/fotos");
} else if ($entity->getSubtype() == "grupo_investigacion") {
    forward($site_url . "{$entity->getSubtype()}/ver/{$entity->guid}/fotos");
} else if ($entity->getSubtype() == "red_tematica") {
    forward($site_url . "redes_tematicas/ver/{$entity->guid}/fotos");
} else if ($entity->getType() == "user") {
    forward($site_url . "profile/{$entity->username}/fotos");
} else {
    forward(REFERER);
}

