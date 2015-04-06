<?php

$convocatoria = get_entity(get_input('guid_conv'));
$evaluador = get_entity(get_input('guid_ev'));

$subject = "Seleccionado como Evaluador de Convocatoria";
$mensaje = "Te han seleccionado como evaluador de la convocatoria \"{$convocatoria->name}\". Debes Esperar  a que se te asigne una investigación en esta convocatoria.";

if (add_entity_relationship($evaluador->guid, 'es_evaluador_convocatoria', $convocatoria->guid)) {
    $evaluador->removeRelationship($convocatoria->guid, 'preinscrito_evaluador_convocatoria');
    $result = messages_send($subject, $mensaje, $evaluador->guid, 0, $reply);
    if (!empty($evaluador->email)) {
        elgg_enviar_correo($evaluador->email, $subject, $mensaje);
    }
    system_message(elgg_echo('inscripcion_evaluador:aceptado:ok'), 'success');
    forward(REFERER);
} else {
    register_error(elgg_echo('inscripcion_evaluador:acptado:fail'));
    forward(REFERER);
}