<?php

$mensajes = get_input('mensajes');
foreach ($mensajes as $mensaje) {
    $msj = get_entity($mensaje);
    $msj->setMetaData('hiddenTo', 1);
}
if(count($mensajes)==0){
    register_error("No selecciono ningún mensajes para eliminar");
}else{
    system_message("Los mensajes fueron eliminados correctamente");
}
forward(REFERER);
