<?php

elgg_load_library('tidypics:upload');
$guid = (int) get_input('guid');
$nombre = get_input('nombre');
$url_web = get_input('url_web');
$url_flash = get_input('url_flash');
$num_images = 0;
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
$revista= new ElggRevista();
$revista->name=$nombre;
$revista->url_flash=$url_flash;
$revista->url_html=$url_web;
$revista->imagen=$image->guid;
$revista->access_id= 2;
$revista->save();
if($revista){
	$usuarios= elgg_get_entities(array('type'=>'user', 'limit'=>0));
	$data="Envio de Correos creación de revista $revista->name: ". date("d m Y H:m:s")."\n";
	$data.="********* Informacion envio de Correos ******** \n";
	foreach($usuarios as $usuario){
		$mensaje="Hola, ".$usuario->name.",<br><br> Para conocer mas acerca de nuestra comunidad enjambre te invitamos a ver la nueva revista informativa <a href='".$url_web."'>".$nombre.".</a>.";
		elgg_enviar_correo($usuario->email, "Nueva Revista Enjambre", utf8_decode($mensaje));
		$data.="Usuario: $usuario->email; Hora de envio:".date("d m Y H:m:s")." \n";
	}
	$nombre_archivo = "logs_envio_correo-$revista->name".date("d m Y H:m:s").".txt"; 
    if($archivo = fopen($nombre_archivo, "a"))
    {
        fwrite($archivo, $data. "\n");
        fclose($archivo);
    }
}
forward(REFERER);



