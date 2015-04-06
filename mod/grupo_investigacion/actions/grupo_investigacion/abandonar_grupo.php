<?php
/**
 *  Action que elimina la relación de un usuario con el grupo
 */

$user_guid = elgg_get_logged_in_user_entity();
$gru_id = get_input("id_grupo");

//echo 'Por qui llego '.$gru_id.' mas esto '.$gru_nom.' con migo '.$user_guid;

$nuevoUsuario= new ElggUser($user_guid->guid);


//$nuevoUsuario->;
if($nuevoUsuario->removeRelationship($gru_id , "es_miembro_de")){
    system_message(elgg_echo("remove:relation:ok"), 'success');
}else{
    system_messages(elgg_echo("remove:relation:no"),'error');
}
  
 forward("/grupo_investigacion/ver/".$gru_id);