<?php
$guid = get_input('guid');
$convocatoria = get_input('convocatoria');
if(!$guid || !$convocatoria){
    register_error("Ha ocurrido un error en la operación");
    forward(REFERER);
}
if(remove_entity_relationship($guid, 'inscrita_a_convocatoria_especial', $convocatoria)){
    system_message("La investigación se ha rechazado exitosamente");
}else{
    register_error("No se ha podido rechazar esta investigación, intenta nuevamente.");
}
forward(REFERER);