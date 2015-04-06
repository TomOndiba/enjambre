<?php

/**
 * Action que actualiza la información de una Línea Temáica
 * @author DIEGOX_CORTEX
 */
elgg_load_library('tidypics:upload');
$nombre = get_input('nombre');
$existe_patro = elgg_existe_patrocinador($nombre);


//if ($existe_grupo) {
//system_messages(elgg_echo('linea:repetido'), 'error');
//} else {

$id = get_input('id');
$patrocinador = new ElggPatrocinador($id);
$patrocinador->title = $nombre;
$options = array(
    'guid' => $patrocinador->guid,
    'metadata_name' => 'logo',
    'limit' => false
);
$g = elgg_delete_metadata($options);

//Cargo la imagen nueva
$name = htmlspecialchars($_FILES['images']['name'], ENT_QUOTES, 'UTF-8', true);
$mime = tp_upload_get_mimetype($name);
$image = new TidypicsImage();
$image->title = $name;
$image->container_guid = $guid;
$image->setMimeType($mime);
$image->access_id = 1;

$data = array();
foreach ($_FILES['images'] as $key => $value) {
    $data[$key] = $value;
}

$result = $image->saveImg($data);
$user = elgg_get_logged_in_user_entity();
//fin de cargar l imagen

$b = create_metadata($patrocinador->guid, 'logo', $image->guid, 'text', $user->guid, ACCESS_PUBLIC);

$guid = $patrocinador->save();

if ($guid)
    system_messages(elgg_echo('patrocinadores:edit:ok'), 'success');
else
    register_error(elgg_echo('epatrocinadores:edit:fail'), 'error');
//}

forward("/patrocinadores/");
