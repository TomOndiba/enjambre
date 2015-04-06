<?php

$id_inv = get_input('id_inv');
$id_linea = get_input('id_linea');
$id_conv = get_input('id_conv');
$conv = new ElggConvocatoria($id_conv);

$url_conv = elgg_get_site_url() . "convocatorias/ver/$id_conv";
$investigacion = new ElggInvestigacion($id_inv);

if ($investigacion->addRelationship($id_conv, "seleccionada_en_convocatoria")) {
    if ($investigacion->addRelationship($id_linea, "seleccionada_en_" . $id_conv . "_con_linea_tematica")) {

        //Elimina las relaciones anteriores de la investigacion
        $investigacion->removeRelationship($id_conv, "invitada_en_convocatoria");
        $investigacion->removeRelationship($id_linea, "invitada_en_" . $id_conv . "_con_linea_tematica");

        $investigacion->elegible = 'aceptada';
        $investigacion->save();

        //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la invitacion a la investigacion
        $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
        $user = elgg_get_usuario_byId($grupo[0]->owner_guid);
        $institucion = elgg_get_relationship($grupo[0], "pertenece_a");

        $subject = "Invitación aceptada en convocatoria $conv->name";
        $mensaje = " Cordial Saludo, Nos permitimos confirmarle la aceptación de la invitación a la Investigación <b>" . $investigacion->name . "</b>"
                . " dentro de la convocatoria <a href='$url_conv'>{$conv->name}</a>. La investigación se encuentra en espera de asignación de presupuesto.";
        $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
        if (!empty($user->email)) {
            elgg_enviar_correo($user->email, $subject, $mensaje);
        }

        $mensaje1 = " Cordial Saludo, Nos permitimos confirmarle la aceptación de la invitación a la Investigación <b>" . $investigacion->name .
                "</b> perteneciente al grupo " . $grupo[0]->name . " de su institución " . $institucion[0]->name . ", dentro de la convocatoria <a href='$url_conv'>{$conv->name}</a>" .
                ". La investigación se encuentra en espera de asignación de presupuesto.";

        $result2 = messages_send($subject, $mensaje1, $institucion[0]->owner_guid, 0, $reply);
        if (!empty($institucion[0]->email)) {
            elgg_enviar_correo($institucion[0]->email, $subject, $mensaje1);
        }
        system_message(elgg_echo("invitacion:aceptada:ok"));
    } else {
        $investigacion->removeRelationship($id_conv, "seleccionada_en_convocatoria");
        register_error(elgg_echo("invitacion:aceptada:error"));
    }
} else {
    register_error(elgg_echo("invitacion:aceptada:error1"));
}


forward("convocatorias/ver/$id_conv");
