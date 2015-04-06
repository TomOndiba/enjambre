<?php

$convocatoria = get_input("convocatoria");
$asesor = get_input("asesor");
$estudios = get_input('educacion');
$experiencia = get_input('experiencia');
$total = get_input('total');
$evaluacion = new ElggEvaluacionAsesor(get_input('evaluacion'));
$evaluacion->update($experiencia, $estudios, $total);
$user = elgg_get_usuario_byId($asesor);
$user->removeRelationship($convocatoria, "inscripcion_asesor");
$user->removeRelationship($convocatoria, "asesor");

if ($total < 12) {
    if ($user->addRelationship($convocatoria, "inscripcion_asesor")) {
        system_message(elgg_echo("asesor:inscripcion:exitoso"), 'success');
        elgg_enviar_correo($usuario->email, "Inscripción como Asesor", "Ahora estas preinscrito como Asesor. Debes esperara que el coordinador te acepte para continuar con el proceso de investigación.");
    } else {
        register_error(elgg_echo("asesor:inscripcion:error"));
    }
} else {
    if ($user->addRelationship($convocatoria, "asesor")) {
        system_message(elgg_echo("asesor:inscripcion:exitoso"), 'success');
        elgg_enviar_correo($usuario->email, "Inscripción como Asesor", "Ahora estas preinscrito como Asesor. Debes esperara que el coordinador te acepte para continuar con el proceso de investigación.");
    } else {
        register_error(elgg_echo("asesor:inscripcion:error"));
    }
}
$site= elgg_get_site_url()."convocatorias/vinculacion/asesores/{$convocatoria}";
forward(REFERER);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

