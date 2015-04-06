<?php

elgg_load_library('tidypics:upload');
$guid = (int) get_input('guid');
$titulo = get_input('nombre');
$descripcion = get_input('descripcion');
$forward = get_input('forward');
$album = new TidypicsAlbum();
$album->owner_guid = $guid;
$album->title = $titulo;
$album->description = $descripcion;
$album->access_id = ACCESS_PUBLIC;
$album = $album->saveReturn();

$num_images = 0;
if (!empty($_FILES['imagenes']['name'][0])) {
    $num_images++;
}

if ($num_images == 0) {
    // have user try again
    register_error(elgg_echo('tidypics:noimages'));
    forward(REFERER);
}

// create the image object for each upload
$uploaded_images = array();
$not_uploaded = array();
$error_msgs = array();
foreach ($_FILES['imagenes']['name'] as $index => $value) {
    $data = array();
    foreach ($_FILES['imagenes'] as $key => $values) {
        $data[$key] = $values[$index];
    }
  
    $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8', true);
    $mime = tp_upload_get_mimetype($name);
    $image = new TidypicsImage();
    $image->title = $name;
    $image->container_guid = $album;
    $image->setMimeType($mime);
    $image->access_id = 1;
    $image->save($data);
}
system_message("Album creado correctamente");


if ($result) {
    add_to_river('river/object/image/create', 'create', $owner->guid, $image->getGUID());
}
$site_url = elgg_get_site_url();

$album2=  get_entity($album);
$entity = get_entity($album2->owner_guid);

if ($entity->getSubtype() == "institucion") {
    forward($site_url . "instituciones/ver/{$entity->guid}/fotos/$album2->guid");
} else if ( $entity->getSubtype() == "grupo_investigacion") {
    forward($site_url . "{$entity->getSubtype()}/ver/{$entity->guid}/fotos/$album2->guid");
} 
else if ($entity->getSubtype() == "red_tematica") {
    forward($site_url . "redes_tematicas/ver/{$entity->guid}/fotos/$album2->guid");
} 
else if ($entity->getType() == "user") {
    forward($site_url . "profile/{$entity->username}/fotos/$album2->guid");
} else {
    forward(REFERER);
}



