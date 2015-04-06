<?php
$asesoria = new ElggAsesoria(get_input('asesoria'));
$asesoria->resumen = get_input('resumen');
if($asesoria->save()){
    system_message("El resumen de las asesoria se guardo exitosamente.");
}else{
    register_error("Ha ocurrido un error en el registro del resumen de la asesoria. Intentelo nuevamente.");
}
forward(REFERER);