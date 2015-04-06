<?php

$usuario = get_input('id');
$grupo =get_input('grupo');



if(add_entity_relationship($usuario, "usuario_desactivado_de", $grupo)){
    remove_entity_relationship($usuario,"es_miembro_de", $grupo);
    system_messages(elgg_echo("group:usuario:desactivate:ok"), 'success');
}else{
    register_error(elgg_echo("group:usuario:desactivate:fail"));
}

forward(REFERER);