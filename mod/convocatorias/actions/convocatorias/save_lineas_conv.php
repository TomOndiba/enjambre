<?php
/**
 * Crea las relaciones necesarias para asociar líneas temáticas a una convocatoria
 */

$id_convocatoria=get_input('id');
$lineas=get_input('lineas');
$lineas2=get_input('lineas2');

$convocatoria= new ElggConvocatoria($id_convocatoria);
$sw=true;
foreach ($lineas as $li){
    if(!$convocatoria->addRelationship($li, 'tiene_la_línea_temática')){
        $sw=$sw&false;
    }
}

if(sizeof($lineas2)!=0){
    foreach ($lineas2 as $li){
        if(!$convocatoria->addRelationship($li, 'tiene_la_línea_temática')){
            $sw=$sw&false;
        }
    }   
}

if(!$sw){
    register_error(elgg_echo("convocatoria:error:rel_lin_conv"));
    forward(REFERER);
}else{
    system_message(elgg_echo("convocatoria:ok:rel_lin_conv"));
    forward('/convocatorias/lineas/'.$id_convocatoria);
}