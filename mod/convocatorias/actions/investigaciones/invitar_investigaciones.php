<?php

$id_conv = get_input('id_conv');
$conv = new ElggConvocatoria($id_conv);
$elegidas = get_input('elegidas');
$url_conv_nueva = elgg_get_site_url() . "convocatorias/ver/$id_conv";

$sw = true;
foreach ($elegidas as $el) {
    $dat = explode("/", $el);
    $id_inv = $dat[0];
    $conv_ant = $dat[1];
    $convocatoria = new ElggConvocatoria($conv_ant);
    $linea_ant = $dat[2];
    $investigacion = new ElggInvestigacion($id_inv);

    //Se añade a la nueva convocatoria como invitada_en_convocatoria
    if ($investigacion->addRelationship($id_conv, "invitada_en_convocatoria")) {
        if ($investigacion->addRelationship($linea_ant, "invitada_en_" . $id_conv . "_con_linea_tematica")) {
            //Se saca del banco de elegibles
            $investigacion->elegible = 'invitada';
            $investigacion->save();
            $url_aceptar_inv = elgg_get_site_url() . "convocatorias/invitacion/$id_conv/$id_inv/$linea_ant";

            //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la invitacion a la investigacion
            $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
            $user = elgg_get_usuario_byId($grupo[0]->owner_guid);
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");

            $subject = "Invitación para financiación de investigación aprobada en nueva convocatoria";
            $mensaje = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name . "</b> que partició en la convocatoria {$convocatoria->name} y obtuvo"
                    . " una calificación de Aprobada, ha sido seleccionada para ser financiada en la nueva convocatoria <a href='$url_conv_nueva'>{$conv->name}</a>. Para aceptar la invitación y "
                    . " participar en la convocatoria por favor de clic <a href='$url_aceptar_inv'>aquí</a>.";
            $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
            if (!empty($user->email)) {
                elgg_enviar_correo($user->email, $subject, $mensaje);                    
            }

            $mensaje1 = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
                    "</b> perteneciente al grupo " . $grupo[0]->name . " de su institución " . $institucion[0]->name .
                    ", la cual partició en la convocatoria {$convocatoria->name} y obtuvo"
                    . " una calificación de Aprobada, ha sido seleccionada para ser financiada en la nueva convocatoria <a href='$url_conv_nueva'>{$conv->name}</a>. "
                    . "Para aceptar la invitación y "
                    . " participar en la convocatoria por favor de clic <a href='$url_aceptar_inv'>aquí</a>.";

            $result2 = messages_send($subject, $mensaje1, $institucion[0]->owner_guid, 0, $reply);
            if(!empty($institucion[0]->email)) {
                elgg_enviar_correo( $institucion[0]->email, $subject, $mensaje1);    
            }
        } else {
            $sw = $sw & false;
        }
    } else {
        $sw = $sw & false;
    }
}


if ($sw) {
    system_message(elgg_echo("convocatoria:invitada:ok"));
    forward('/convocatorias/banco_elegibles/' . $id_conv);
} else {
    register_error(elgg_echo("convocatoria:invitada:error"));
    forward(REFERER);
}
