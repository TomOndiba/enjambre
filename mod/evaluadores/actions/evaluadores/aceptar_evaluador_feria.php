<?php

$feria = get_entity(get_input('guid_fer'));
$evaluador = get_entity(get_input('guid_ev'));

$subject = "Ha sido aceptado como evaluador de Feria";
$mensaje = "Felicidades ha sido seleccionado como evaluador en la feria {$feria->name}. Ahora debe esperar a que el coordinador le signe futuras investigaciones gracias.";

if (add_entity_relationship($evaluador->guid, 'es_evaluador_feria', $feria->guid)) {
    //remove_entity_relationship($evaluador->guid, 'preinscrito_evaluador_feria', $feria->guid);
    $evaluador->removeRelationship($feria->guid, 'preinscrito_evaluador_feria');
    $result = messages_send($subject, $mensaje, $evaluador->guid, 0, $reply);
    if (!empty($evaluador->email)) {
        elgg_enviar_correo($evaluador->email, $subject, $mensaje);
    }
    system_message(elgg_echo('inscripcion_evaluador_feria:aceptado:ok'), 'success');
    forward(REFERER);
} else {
    register_error(elgg_echo('inscripcion_evaluador_feria:acptado:fail'));
    forward(REFERER);
}
