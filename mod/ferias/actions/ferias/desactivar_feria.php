<?php

$feria = get_entity(get_input("id_feria"));

if($feria->disable()){
    system_messages(elgg_echo('Se ha desactivado'), 'success');
}else{
    register_error(elgg_echo('No se ha completado la accion'));
}

forward(REFERER);
