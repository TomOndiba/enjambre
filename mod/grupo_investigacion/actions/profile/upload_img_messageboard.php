<?php

elgg_load_library('tidypics:upload');
$guid = (int) get_input('guid');


	$mimeR = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
	# Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
	if( !in_array( $_FILES['images']['type'], $mimeR ) )
	{
            register_error("No se pudo publicar la Foto porque el archivo subido no era una Imagen");
             forward(REFERER);
	}




$album = elgg_get_album_muro($guid);
if ($album==null) {
    $album = new TidypicsAlbum();
    $album->owner_guid = $guid;
    $album->title = "Fotos de Muro";
    $album->access_id=ACCESS_PUBLIC;
    $album = $album->saveReturn();
}
$num_images = 0;
if (!empty($_FILES['images']['name'])) {
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
$data = array();
foreach ($_FILES['images'] as $key=>$value) {
    $data[$key] = $value;
}
$name = htmlspecialchars($_FILES['images']['name'], ENT_QUOTES, 'UTF-8', true);
$mime = tp_upload_get_mimetype($name);
$image = new TidypicsImage();
$image->title = $name;

$image->container_guid = $album;
$image->setMimeType($mime);
$image->access_id = ACCESS_PUBLIC ;
$result = $image->saveImg($data);
$url = elgg_get_site_url()."photos/thumbnail/{$result}/large/";
$user = elgg_get_logged_in_user_entity();
$owner = get_entity($guid);
$message_content = "<img src='$url'></img>";
$resultado = messageboard_add($user, $owner, $message_content, ACCESS_PUBLIC);
system_message("Imagen subida correctamente");
forward(REFERER);
