<?php

/**
 * Archivo que define el lenguaje español para el plugin.
 * @author DIEGOX_CORTEX
 */
$spanish = array(
    /**
     * Menu items and titles
     */
    'messages_evaluador' => "Mensajes",
    'messages_evaluador:unreadcount' => "%s no leidos",
    'messages_evaluador:back' => "regresar a los mensajes",
    'messages_evaluador:user' => "Bandeja de entrada de %s",
    'messages_evaluador:posttitle' => "Mensajes de %s: %s",
    'messages_evaluador:inbox' => "Bandeja de entrada",
    'messages_evaluador:send' => "Enviar",
    'messages_evaluador:sent' => "Enviado",
    'messages_evaluador:message' => "Mensaje",
    'messages_evaluador:title' => "Asunto",
    'messages_evaluador:to' => "Para",
    'messages_evaluador:from' => "De",
    'messages_evaluador:fly' => "Enviar",
    'messages_evaluador:replying' => "Respondiendo a",
    'messages_evaluador:inbox' => "Bandeja de entrada",
    'messages_evaluador:sendmessage' => "Enviar un mensaje",
    'messages_evaluador:compose' => "Escribir un mensaje",
    'messages_evaluador:add' => "Escribir un mensaje",
    'messages_evaluador:sentmessages' => "Mensajes enviados",
    'messages_evaluador:recent' => "Mensajes recientes",
    'messages_evaluador:original' => "Mensaje original",
    'messages_evaluador:yours' => "Su mensaje",
    'messages_evaluador:answer' => "Responder",
    'messages_evaluador:toggle' => 'Seleccionar/Deseleccionar todos',
    'messages_evaluador:markread' => 'Marcar como leido',
    'messages_evaluador:recipient' => 'Seleccione un destinatario&hellip;',
    'messages_evaluador:to_user' => 'Para: %s',
    'messages_evaluador:select' => 'Seleccione una Opción para enviar el mensaje',
    'messages_evaluador:new' => 'Mensaje nuevo',
    'notification:method:site' => 'Sitio',
    'messages_evaluador:error' => 'Ocurri&oacute; un problema al guardar su mensaje. Por favor intente nuevamente.',
    'item:object:messages_evaluador' => 'Mensajes',
    /**
     * Status messages_evaluador
     */
    'messages_evaluador:posted' => "Se ha enviado mensaje notificando a los evaluadores.",
    'messages_evaluador:success:delete:single' => 'El mensaje fue eliminado',
    'messages_evaluador:success:delete' => 'Mensajes eliminados',
    'messages_evaluador:success:read' => 'Mensajes marcados como leidos',
    'messages_evaluador:error:messages_not_selected' => 'No hay mensajes seleccionados',
    'messages_evaluador:error:delete:single' => 'No se puede eliminar el mensaje',
    'messages_evaluador:asunto' => 'Información de Convocatoria Abierta',
    'messages_evaluador:bodyp' => 'Se ha abierto una nueva Convocatoria',
    'messages_evaluador:bodym' => ' y nos gustaria que fueras parate de ella como evaluador,'
    . 'esperamos contar contigo. Ingresa en la comunidad Virtual Enjambre e inscribite como evaluador en esta convocatoria'
    .' ¡Te esperamos!.<br><br>',
    'messages_evaluador:bodyf' => '<br><br>Gracias.'
    . '<br><br><br>'
    . 'Comunidad Virtual Enjambre ',
    'messages_evaluador:url' => 'Puedes inscribirte en este Link: ',
    
    /**
     * Email messages_evaluador
     */
    'messages_evaluador:email:subject' => 'Tiene un mensaje',
    'messages_evaluador:email:body' => "Tiene un nuevo mensaje de %s.:

	
	%s

	
	Para ver sus mensajes, haga click a continuaci&oacute;n:

	%s

	Para enviar un mensaje a %s, haga click aqu&iacute;:

	%s

	No puede responder directamente a este correo.",
    /**
     * Error messages_evaluador
     */
    'messages_evaluador:blank' => "Debes escribir algo en el cuerpo del mensaje antes de guardar.",
    'messages_evaluador:notfound' => "No se pudo encontrar el mensaje especificado.",
    'messages_evaluador:notdeleted' => "No se pudo eliminar este mensaje.",
    'messages_evaluador:nopermission' => "No tiene permisos para modificar ese mensaje.",
    'messages_evaluador:nomessages' => "No hay mensajes.",
    'messages_evaluador:user:nonexist' => "No encontramos al destinatario entre los usuarios registrados.",
    'messages_evaluador:user:blank' => "No ha seleccionado a nadie como destinatario.",
    'messages_evaluador:deleted_sender' => 'Usuario borrado',
);

add_translation("es", $spanish);
