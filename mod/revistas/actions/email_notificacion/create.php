<?php


$asunto = utf8_decode(get_input('asunto'));
$mensaje = get_input('mensaje');
$usuarios= elgg_get_entities(array('type'=>'user', 'limit'=>0));
	$data="Envio de Correos creación: ". date("d m Y H:m:s")."\n";
	$data.="********* Informacion envio de Correos ******** \n";
	$data.="Mensaje:".$mensaje."\n";
    $data.="Asunto:".$asunto."\n";
	foreach($usuarios as $usuario){
		$men="Hola, ".$usuario->name.",<br><br>".$mensaje;
		elgg_enviar_correo($usuario->email, $asunto, utf8_decode($men));
		$data.="Usuario: $usuario->email; Hora de envio:".date("d m Y H:m:s")." \n";
	}
	$nombre_archivo = "logs_envio_correo_masivo".date("d m Y H:m:s").".txt"; 
    if($archivo = fopen($nombre_archivo, "a"))
    {
        fwrite($archivo, $data. "\n");
        fclose($archivo);
    }
forward(REFERER);
