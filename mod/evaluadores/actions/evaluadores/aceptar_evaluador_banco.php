<?php

$evaluador = get_entity(get_input('guid_eval'));

$option = array(
    'type' => 'group',
    'subtype' => 'RedEvaluadores',
);

$red_evaluadores = elgg_get_entities($option);
$group = $red_evaluadores[0];
$grupo = get_entity($group->guid);

$subject = "Seleccionado como Evaluador en el Banco de Evaluadores";
$mensaje = "Cordial Saludo, nos permitimos informarle que su solicitud al Banco de Evaluadores ha sido aceptada. Ahora debe esperar a que se realicen convocatorias de evaluadores en alguna feria o convocatoria.. Gracias.";


if (check_entity_relationship($evaluador->guid, 'membership_request', $grupo->guid)) {
    remove_entity_relationship($evaluador->guid, 'membership_request', $grupo->guid);
}

if ($evaluador->addRelationship($grupo->guid, "member")) {
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
