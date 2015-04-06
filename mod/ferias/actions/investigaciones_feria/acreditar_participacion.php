<?php

$id_inv = get_input('id_inv');
$id_feria = get_input('id_feria');

$investigacion = new ElggInvestigacion($id_inv);
$feria = new ElggFeria($id_feria);
$url_feria = elgg_get_site_url() . "feria/ver/$id_feria";

if ($investigacion->addRelationship($id_feria, "acreditada_en")) {
    $investigacion->addRelationship($id_feria, "participa_en_municipal");
    $investigacion->removeRelationship($id_feria, "inscrita_en");

    //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la selección de la investigacion
    $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
    $user = elgg_get_usuario_byId($grupo[0]->owner_guid);
    $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
    $user1 = elgg_get_usuario_byId($institucion[0]->owner_guid);

    $subject = "Investigación acreditada en Feria Municipa";
    $mensaje = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
            "</b> ha sido acreditada como participante de la feria <a href='$url_feria'>" . $feria->name . "</a>.";
    if (!empty($user->email)) {
        $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
        elgg_enviar_correo($user->email, $subject, $mensaje);
    }
    if (!empty($institucion[0]->email)) {
        $mensaje1 = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
                "</b> perteneciente al grupo " . $grupo[0]->name . " de su institución " . $institucion[0]->name .
                ",ha sido acreditada como participante de la feria <a href='$url_feria'>" . $feria->name . "</a>.";
        $result1 = messages_send($subject, $mensaje1, $institucion[0]->owner_guid, 0, $reply);
        elgg_enviar_correo($institucion[0]->email, $subject, $mensaje1);
    }

    system_message(elgg_echo("acreditacion:feria:ok"));
} else {
    register_error(elgg_echo("feria:action:inscripcion:fail"));
}

forward(REFERER);
