<?php
elgg_load_library('tidypics:upload');
$nombre=  get_input('nombre');
$url=  get_input('url');
$investigacion= get_input('investigacion');
$etapa=  get_input('etapa');
$todas_etapas=  get_input('etapas_todas');
$categoria= get_input('categoria');



$componente= new ElggComponente();
$componente->title=$nombre;
$componente->url=$url;

if(isset($todas_etapas)){
$componente->etapa="todas";
}
else{
 $componente->etapa=$etapa;  
}
$componente->owner_guid= $investigacion;
$componente->categoria=$categoria;


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



if($guid){
  system_message(elgg_echo('El Componente fue registrado con éxito'), 'success');   
}
else{
  system_message(elgg_echo('No se pudo registrar el Componente'), 'error');    
}
forward(REFERRER);