<?php

elgg_load_library('tidypics:upload');
$guid = (int) get_input('album');
$album = new TidypicsAlbum($guid);


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
    $image->container_guid = $album->guid;
    $image->setMimeType($mime);
    $image->access_id = 1;
    $image->save($data);
}
system_message("La Foto se agregó correctamente");


if ($result) {
    add_to_river('river/object/image/create', 'create', $owner->guid, $image->getGUID());
}

