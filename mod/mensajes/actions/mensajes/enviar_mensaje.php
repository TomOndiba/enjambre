<?php
$usuarios=get_input('usuarios');
$mensaje= get_input('mensaje');
$asunto= get_input('asunto');

foreach($usuarios as $usuario){
    $user= elgg_get_logged_in_user_entity();
    messages_send($asunto, $mensaje, $usuario, $user->guid , 0, true, true);
}
system_message("Se han enviado el mensaje...", 'success');
forward(elgg_get_site_url().'mensajes/enviados');

