<?php


$user= elgg_get_logged_in_user_entity();
$id_red = get_input("id");



$usuario= new ElggUser($user->guid);



if($usuario->removeRelationship($id_red , "peticionUnirse")){
    system_message(elgg_echo("remove:solicitud_red:ok"));
}else{
    register_error(elgg_echo("remove:solicitud_red:no"));
}
  
 forward("/redes_tematicas/ver/".$id_red);

