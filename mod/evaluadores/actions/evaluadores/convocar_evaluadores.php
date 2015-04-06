<?php

$user_login = get_entity(elgg_get_logged_in_user_guid());

$mensaje = get_input("mensaje");
$subject = get_input("subject");
$opcion = get_input('recipient_guid');
$metodo = get_input('metodo');

if ($opcion == 'select') {
    register_error(elgg_echo("messages_evaluador:select"));
    forward(REFERER);
}
if ($opcion == 'evaluadores') {
    $evaluadores = elgg_get_evaluadores();
    foreach ($evaluadores as $evaluador) {
        if ($metodo == 0) {
            $result = messages_send($subject, $mensaje, $evaluador->guid, 0, $reply);
        } else if ($metodo == 1) {
            if (!empty($evaluador->email)) {                
                elgg_enviar_correo($evaluador->email, $subject, $mensaje);
            }
        } else if ($metodo == 2) {
            $result = messages_send($subject, $mensaje, $evaluador->guid, 0, $reply);
            if (!empty($evaluador->email)) {
                elgg_enviar_correo($evaluador->email, $subject, $mensaje);
            }
        }
    }

    system_message(elgg_echo('messages_evaluador:send:ok'));
    forward("/convocatorias");
}