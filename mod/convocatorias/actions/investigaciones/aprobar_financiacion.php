<?php

$id_inv = get_input('id_inv');
$id_linea = get_input('id_linea');
$id_conv = get_input('id_conv');

$investigacion = new ElggInvestigacion($id_inv);

if ($investigacion->addRelationship($id_conv, "seleccionada_en_convocatoria")) {
    if ($investigacion->addRelationship($id_linea, "seleccionada_en_" . $id_conv . "_con_linea_tematica")) {

        //Elimina las relaciones anteriores de la investigacion
        $investigacion->removeRelationship($id_conv, "evaluada_en_convocatoria");
        $investigacion->removeRelationship($id_linea, "evaluada_en_" . $id_conv . "_con_linea_tematica");

        $investigacion->elegible = 'false';
        $investigacion->save();

        //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la selección de la investigacion
        $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
        $user = elgg_get_usuario_byId($grupo[0]->owner_guid);

        $subject = "Investigación Seleccionada";
        $conv = get_entity($id_conv);
        $mensaje = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name . "</b> ha sido seleccionada dentro de la convocatoria $conv->name";
        $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
        if (!empty($user->email)) {
            elgg_enviar_correo($user->email, $subject, $mensaje);
        }
        system_message(elgg_echo("seleccionada:convocatoria:ok"));
    } else {
        $investigacion->removeRelationship($id_conv, "seleccionada_en_convocatoria");
        register_error(elgg_echo("seleccionada:convocatoria:error"));
    }
} else {
    register_error(elgg_echo("seleccionada:convocatoria:error"));
}


forward("convocatorias/investigaciones/$id_conv#preseleccionadas");
