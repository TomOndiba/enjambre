<?php

/**
 * Action que elimina un integrante o un maestro del cuaderno o de una Investigación del Grupo
 */

$id_usuario = get_input('id');
$id_cuad = get_input('id_cuad');




$options = array(
    'type' => 'user',
    'guid' => $id_usuario,
);

$usuario = elgg_get_entities($options);

 if($usuario[0]->getSubtype()=='estudiante'){

    if($usuario[0]->removeRelationship($id_cuad, "hace_parte_de")){
       system_messages(elgg_echo('integrante:eliminado:cuaderno:ok'),'success');
    
    }
    
    else {
        system_messages(elgg_echo('integrante:eliminado:cuaderno:not'), 'error');
 }
 
    }
    
    
    else{
        if($usuario[0]->removeRelationship($id_cuad, "es_colaborador_de")){
       system_messages(elgg_echo('maestro:eliminado:cuaderno:ok'),'success');
    
    }
    
    else {
        system_messages(elgg_echo('maestro:eliminado:cuaderno:not'), 'error');
 }
        
    }
forward(REFERER);

