<?php

/**
 * Action para enviar mensaje de notificación interno a evaluadores da la comunidad.
 * 
 * @author DIEGOX_CORTEX
 */
$subject = strip_tags(get_input('subject'));
$body = get_input('body');
$recipient_guid = get_input('recipient_guid');
$evalua = get_input('revaluadores');

$guid_evaluadores = explode(',', $evalua);





elgg_make_sticky_form('messages_evaluador');

//$reply = get_input('reply',0); // this is the guid of the message replying to

if($recipient_guid == 'select'){
    register_error(elgg_echo("messages_evaluador:select"));
    forward("messages_evaluador/add_ev");
}

//if (!$recipient_guid) {
//    register_error(elgg_echo("messages_evaluador:user:blank"));
//    forward("messages_evaluador/add_ev");
//}
//
//$user = get_user($recipient_guid);
//if (!$user) {
//    register_error(elgg_echo("messages_evaluador:user:nonexist"));
//    forward("messages_evaluador/add_ev");
//}

// Make sure the message field, send to field and title are not blank
if (!$body || !$subject) {
    register_error(elgg_echo("messages_evaluador:blank"));
    forward("messages_evaluador/add_ev");
}



// Otherwise, 'send' the message 
if ($recipient_guid == 'evaluadores') {
    foreach ($guid_evaluadores as $e) {
        $guid = (int) $e;
        if ($guid > 0) {
            $result = messages_send($subject, $body, $guid, 0, $reply);

        }
    }
}

//$result = messages_send($subject, $body, $recipient_guid, 0, $reply);
// Save 'send' the message
if (!$result) {
    register_error(elgg_echo("messages_evaluador:error"));
    forward("messages_evaluador/add_ev");
}

elgg_clear_sticky_form('messages_evaluador');

system_message(elgg_echo("messages_evaluador:posted"));

forward('/convocatorias/');
