<?php

$guid=  get_input('id_evento');
$id_conv=  get_input('id_conv');
$asistentes=get_input('asistentes');
$sw=true;
foreach($asistentes as $as){
    $options=array(
        'type'=>'user',
        'guid'=>$as,
    );
    $usuario=  elgg_get_entities($options);
    $user=$usuario[0];
    
    if(!$user->addRelationship($guid, "asistió_al_evento")){
       $sw=$sw&false;  
    }
}

if($sw){
    system_message(elgg_echo("evento:ok:nueva:asistencia"));
    forward('/eventos/listar_asistentes/'.$guid.'/'.$id_conv);
}else{
   register_error(elgg_echo("evento:error:nueva:asistencia"));
    forward(REFERER);
}

