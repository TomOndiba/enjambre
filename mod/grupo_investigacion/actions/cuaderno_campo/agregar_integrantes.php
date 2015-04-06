<?php
/**
 * Action que  permite agregar integrantes al cuaderno o a la investigacion 
 */

$id_grupo=  get_input('id_grupo');
$id_cuad=  get_input('id_cuad');
$integrantes=get_input('integrantes');

$sw=false;
foreach($integrantes as $as){
    $options=array(
        'type'=>'user',
        'guid'=>$as,
    );
    $usuario=  elgg_get_entities($options);
    $user=$usuario[0];
    
    if($user->addRelationship($id_cuad, "hace_parte_de")){
        
       $cuaderno_nota=new ElggCuadernoNota();
       $cuaderno_nota->owner_guid=$id_cuad;
       $cuaderno_nota->container_guid=$as;
       $guid=$cuaderno_nota->save();
       $sw=true;
    }
}

if($sw){
    system_message(elgg_echo("cuaderno:ok:nuevo:integrantes"));
    forward(REFERER);
}else{
   register_error(elgg_echo("cuaderno:error:nuevo:integrantes"));
    forward(REFERER);
}

