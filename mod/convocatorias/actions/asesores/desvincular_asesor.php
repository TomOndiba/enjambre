<?php
$convocatoria=  get_input("id_conv");
$asesor= get_input("asesor");
$user= elgg_get_usuario_byId($asesor);
$user->removeRelationship($convocatoria, "asesor");
if($user->addRelationship($convocatoria, "inscripcion_asesor")){
    system_message(elgg_echo("asesor:inscripcion:exitoso"), 'success');
    elgg_enviar_correo($usuario->email, "Inscripción como Asesor", "Agradecemos contar con tu participación en la inscripción como asesor, pero lamentamos informate que no haz sido aceptado como Asesor. Por favor no te desanimes e intentalo de nuevo proximamente.");
}else{
    register_error(elgg_echo("asesor:inscripcion:error"));
}
forward(REFERER);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

