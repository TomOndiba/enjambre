<?php

/**
 * Action que registra una Línea Temática
 * @author DIEGOX_CORTEX
 */
elgg_load_library('tidypics:upload');
$nombre = get_input('nombre');
$guid = elgg_get_logged_in_user_guid();

$patrocinador = new ElggPatrocinador();
$patrocinador->title = $nombre;


$name = htmlspecialchars($_FILES['images']['name'], ENT_QUOTES, 'UTF-8', true);

$mime = tp_upload_get_mimetype($name);

$image = new TidypicsImage();
$image->title = $name;
$image->container_guid = $guid;
$image->setMimeType($mime);
$image->access_id = 1;

$data = array();
foreach ($_FILES['images'] as $key=>$value) {
    $data[$key] = $value;
}

$result = $image->saveImg($data);
$url = elgg_get_site_url()."photos/thumbnail/{$result}/large/";
$user = elgg_get_logged_in_user_entity();
$owner = get_entity($guid);
$message_content = "<img src='$url'></img>";
$resultado = messageboard_add($user, $owner, $message_content, ACCESS_PUBLIC);


$patrocinador->logo = $image->guid;
$result_pat = $patrocinador->save();

//$patrocinador->addRelationship($image->guid, 'tiene_la_imagen');

if ($result && $result_pat) {
    system_message(elgg_echo('patrocinador:save:ok'), 'success');
    //add_to_river('river/object/image/create', 'create', $owner->guid, $image->getGUID());
    forward(elgg_get_site_url().'patrocinadores/');
}else{
    register_error(elgg_echo('patrocinador:save:fail'));
    forward(REFERRER);
}
