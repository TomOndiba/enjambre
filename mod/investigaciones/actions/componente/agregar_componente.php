<?php
elgg_load_library('tidypics:upload');
//$nombre=  get_input('nombre');

$nombre=$_POST['nombre'];
$url=  get_input('url');
$etapa=  get_input('etapa');
$investigacion= get_input('investigacion');
$todas_etapas=  get_input('etapas_todas');
$categoria= get_input('categoria');


if ($url && !preg_match("#^((ht|f)tps?:)?//#i", $url)) {
	$url = "http://$url";
}



$componente= new ElggComponente();
$componente->title=$nombre;
$componente->url=$url;

if($todas_etapas){
$componente->etapa="todas";
}
else{
 $componente->etapa=$etapa;  
}

$componente->categoria=$categoria;
$componente->owner_guid=$investigacion;


$name_imagen = htmlspecialchars($_FILES['images']['name'], ENT_QUOTES, 'UTF-8', true);
$mime = tp_upload_get_mimetype($name_imagen);
$image = new TidypicsImage();
$image->title = $name_imagen;
$image->container_guid = $guid;
$image->setMimeType($mime);
$image->access_id = 1;

$data = array();
foreach ($_FILES['images'] as $key=>$value) {
    $data[$key] = $value;
}

$result = $image->saveImg($data);

$componente->icono = $image->guid;
$guid= $componente->save();
system_messages('Agregado correctamente.','success');