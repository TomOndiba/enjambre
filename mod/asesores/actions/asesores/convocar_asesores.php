<?php

$metodo = get_input("metodo");
$mensaje = get_input("mensaje");
$subject = get_input("subject");
$asesores = elgg_get_asesores();
foreach ($asesores as $asesor) {
    if ($metodo == 0) {
        $result = messages_send($subject, $mensaje, $asesor->guid, 0, $reply);
    } else if ($metodo == 1) {
        if (!empty($asesor->email)) {            
            elgg_enviar_correo($asesor->email, $subject, $mensaje);
        }
    } else {
        if (!empty($asesor->email)) {
            elgg_enviar_correo($asesor->email, $subject, $mensaje);
        }
        $result = messages_send($subject, $mensaje, $asesor->guid, 0, $reply);
    }
}
system_message(elgg_echo('asesor:convocar:ok'), 'success');
forward("/convocatorias");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

