<?php

/**
 * Actin que permite eliminar una foto de un album
 */


$foto = get_entity(get_input('foto'));

if($foto->delete()){
    system_messages("Se ha eliminado la foto.", 'success');
}else{
    register_error('No se ha completado la acción.');
}
forward(REFERER);
