<?php


$user_guid = elgg_get_logged_in_user_entity();
$gru_id = get_input("id_grupo");

//echo 'Por qui llego '.$gru_id.' mas esto '.$gru_nom.' con migo '.$user_guid;

$nuevoUsuario= new ElggUser($user_guid->guid);


//$nuevoUsuario->;
if($nuevoUsuario->removeRelationship($gru_id , "peticionUnirse")){
    system_message(elgg_echo("remove:solicitud_peticion:ok"),"success");
}else{
    system_messages(elgg_echo("remove:solicitud_peticion:no"),"error");
}
  
 forward("/grupo_investigacion/ver/".$gru_id);

