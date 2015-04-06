<?php

/**
 * Action que  permite agregar maestros al cuaderno o a la investigacion 
 */


$id_grupo=  get_input('id_grupo');
$guid=  get_input('id_cuad');
$integrantes=get_input('integrantes');

$sw=false;
foreach($integrantes as $as){
    $options=array(
        'type'=>'user',
        'guid'=>$as,
    );
    $usuario=  elgg_get_entities($options);
    $user=$usuario[0];
    
    if($user->addRelationship($guid, "es_colaborador_de")){
//       $libreta_acompanante=new ElggLibretaAcompanante();
//       $libreta_acompanante->owner_guid=$guid;
//       $libreta_acompanante->container_guid=$as;
//       $guid=$libreta_acompanante->save();
//       $sw=true; 
        
       $cuaderno_nota=new ElggCuadernoNota();
       $cuaderno_nota->owner_guid=$guid;
       $cuaderno_nota->container_guid=$as;
       $guid=$cuaderno_nota->save();
       $sw=true;
    }
}



if($sw){
    system_message(elgg_echo("cuaderno:ok:nuevo:maestro"));
    forward(REFERER);

}else{
   register_error(elgg_echo("cuaderno:error:nuevo:maestro"));
    forward(REFERER);
}

