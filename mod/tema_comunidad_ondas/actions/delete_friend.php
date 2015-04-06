<?php

/**
 * Action que elimina un amigo de laun usuario de la comunidad
 * @author DIEGOX_CORTEX
 */

$yo_guid = get_input('id');
$friend_guid = get_input('idf');

if(empty($yo_guid) || empty($friend_guid)){
    register_error('No se pudo completar la acción...');
}else{
    $yo = get_entity($yo_guid);
    $friend = get_entity($friend_guid);
        
    $r1 = remove_entity_relationship($yo_guid, "friend", $friend_guid);
    $r2 = remove_entity_relationship($friend_guid, "friend", $yo_guid);
    
    if($r1 && $r2){
        system_messages('Se ha eliminado a '.$friend->name.' de tu lista de amigos...', 'success');
    }else{
        register_error("No se completo la acción, verifique de nuevo o consulte con el admin...");
    }
}

forward(REFERER);