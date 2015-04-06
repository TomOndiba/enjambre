<?php

/**
 * Action que realiza la activacion de un integrande de grupo de investigacion nuevamente
 * @author DIEGOX_CORTEX
 */

$usuario = get_input('id');
$grupo =get_input('grupo');



if(remove_entity_relationship($usuario, "usuario_desactivado_de", $grupo)){
    add_entity_relationship($usuario,"es_miembro_de", $grupo);
    system_messages(elgg_echo("group:usuario:activate:ok"), 'success');
}else{
    register_error(elgg_echo("group:usuario:activate:fail"));
}

forward(REFERER);