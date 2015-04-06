<?php

elgg_load_library('tidypics:upload');
//$nombre=  get_input('nombre');

$nombre = $_POST['nombre'];
$etapa = get_input('etapa');
$investigacion = get_input('investigacion');
$todas_etapas = get_input('etapas_todas');
$categoria = get_input('categoria');
$tipo=  get_input('tipo');

$componente = new ElggComponente();
$componente->title = $nombre;



if ($todas_etapas) {
    $componente->etapa = "todas";
} else {
    $componente->etapa = $etapa;
}



$componente->categoria = $categoria;
$componente->owner_guid=$investigacion;
        
$prefix = "file/";


$filestorename = elgg_strtolower(time() . $_FILES['fies']['name']);



$mime_type = ElggFile::detectMimeType($_FILES['files']['tmp_name'], $_FILES['upload']['type']);

// hack for Microsoft zipped formats
$info = pathinfo($_FILES['files']['name']);

$name_imagen = htmlspecialchars($_FILES['files']['name'], ENT_QUOTES, 'UTF-8', true);
$mime_type = ElggFile::detectMimeType($_FILES['files']['tmp_name'], $_FILES['files']['type']);

// hack for Microsoft zipped formats
$info = pathinfo($_FILES['files']['name']);
$office_formats = array('docx', 'xlsx', 'pptx');
if ($mime_type == "application/zip" && in_array($info['extension'], $office_formats)) {
    switch ($info['extension']) {
        case 'docx':
            $mime_type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            break;
        case 'xlsx':
            $mime_type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            break;
        case 'pptx':
            $mime_type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
            break;
    }
}

// check for bad ppt detection
if ($mime_type == "application/vnd.ms-office" && $info['extension'] == "ppt") {
    $mime_type = "application/vnd.ms-powerpoint";
}
$image = new ElggFile();
$image->setMimeType($mime_type);
$image->setFilename($prefix . $filestorename);
$image->title = $name_imagen;
$image->access_id = 1;

$data = array();
foreach ($_FILES['files'] as $key => $value) {
    $data[$key] = $value;
}
$image->simpletype = file_get_simple_type($mime_type);

// Open the file to guarantee the directory exists
$image->open("write");
$image->close();
move_uploaded_file($_FILES['files']['tmp_name'], $image->getFilenameOnFilestore());
$guid = $image->saveImg();
// if image, we need to create thumbnails (this should be moved into a function)
if ($guid && $image->simpletype == "image") {
    $image->icontime = time();

    $thumbnail = get_resized_image_from_existing_file($image->getFilenameOnFilestore(), 60, 60, true);
    if ($thumbnail) {
        $thumb = new ElggFile();
        $thumb->setMimeType($_FILES['files']['type']);

        $thumb->setFilename($prefix . "thumb" . $imagestorename);
        $thumb->open("write");
        $thumb->write($thumbnail);
        $thumb->close();

        $image->thumbnail = $prefix . "thumb" . $imagestorename;
        unset($thumbnail);
    }

    $thumbsmall = get_resized_image_from_existing_file($image->getFilenameOnFilestore(), 153, 153, true);
    if ($thumbsmall) {
        $thumb->setFilename($prefix . "smallthumb" . $imagestorename);
        $thumb->open("write");
        $thumb->write($thumbsmall);
        $thumb->close();
        $image->smallthumb = $prefix . "smallthumb" . $imagestorename;
        unset($thumbsmall);
    }

    $thumblarge = get_resized_image_from_existing_file($image->getFilenameOnFilestore(), 600, 600, false);
    if ($thumblarge) {
        $thumb->setFilename($prefix . "largethumb" . $imagestorename);
        $thumb->open("write");
        $thumb->write($thumblarge);
        $thumb->close();
        $image->largethumb = $prefix . "largethumb" . $imagestorename;
        unset($thumblarge);
    }
} elseif ($image->icontime) {
    // if it is not an image, we do not need thumbnails
    unset($image->icontime);

    $thumb = new ElggFile();

    $thumb->setFilename($prefix . "thumb" . $imagestorename);
    $thumb->delete();
    unset($image->thumbnail);

    $thumb->setFilename($prefix . "smallthumb" . $imagestorename);
    $thumb->delete();
    unset($image->smallthumb);

    $thumb->setFilename($prefix . "largethumb" . $imagestorename);
    $thumb->delete();
    unset($image->largethumb);
}
$url = elgg_get_site_url() . "file/download/$image->guid";
$componente->url = $url;
$componente->contenido = 'file';
$componente->archivo=$guid;
$guid_fin = $componente->save();
system_messages('Subido correctamente.', 'success');

$user=  elgg_get_logged_in_user_entity();
if($categoria=="formacion"){
    create_metadata($guid_fin, 'tipo', $tipo, 'text', $user->guid, ACCESS_PUBLIC);
}


//forward(REFERRER);