<?php
/**
 *  Action que elimina la relación de un usuario con el grupo
 */

$user_guid = elgg_get_logged_in_user_entity();
$id_red = get_input("id");



$nuevoUsuario= new ElggUser($user_guid->guid);



if($nuevoUsuario->removeRelationship($id_red , "es_miembro_de")){
    system_message(elgg_echo("remove:relation_red:ok"));
}else{
    register_error(elgg_echo("remove:relation_red:no"));
}
  
 forward("/redes_tematicas/ver/".$id_red);