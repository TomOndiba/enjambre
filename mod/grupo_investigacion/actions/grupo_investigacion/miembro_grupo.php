<?php

/**
 * Action  que aprueba o rechaza la solicitud de unirse al grupo.
 * Si acepta, crea la relacion "es_miembo_de"  y elimina la peticion.
 */

$id_usuario = get_input('id_miembro');
$id_grupo = get_input('id_grupo');
$acepta = get_input('acepta');// Recibe true si se acepta la solicitud



$options = array(
    'type' => 'user',
    'guid' => $id_usuario,
);

$usuario = elgg_get_entities($options);


if ($acepta =='true') { //Si acepta el usuario en el grupo crea la relación del usuario con el Grupo

    if ($usuario[0]->addRelationship($id_grupo, "es_miembro_de")) {

        $usuario[0]->removeRelationship($id_grupo, "peticionUnirse");
        system_messages(elgg_echo('El Usuario ha sido aceptado al Grupo'), 'success');
        
    } else {
        system_messages(elgg_echo('El Usuario no ha sido aceptado en el Grupo'), 'error');
    }
}

else //Si rechaza el usuario en el grupo, se elimina la solicitud
    {
    if($usuario[0]->removeRelationship($id_grupo, "peticionUnirse"))
       system_messages(elgg_echo('La solicitud ha sido eliminada'),'success');
    
    }
forward(REFERER);
