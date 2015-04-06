<?php

$id_feria = get_input('id_feria');
$feria = new ElggFeria($id_feria);
$inv_finalistas = elgg_get_relationship_inversa($feria, "finalista_en");
$url_feria = elgg_get_site_url() . "ferias/detalles/$id_feria";

$bool = true;

if ($feria->tipo_feria == 'Municipal') {
    $msje = " Debe prepararse para una siguiente feria departamental a la que será invitado más adelante.";
}

foreach ($inv_finalistas as $investigacion) {
    //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la selección de la investigacion
    $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
    $user = elgg_get_usuario_byId($grupo[0]->owner_guid);
    $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
    $user1 = elgg_get_usuario_byId($institucion[0]->owner_guid);

    $subject = "¡Felicitaciones, eres finalista!";
    $mensaje = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
            "</b> perteneciente a su grupo " . $grupo[0]->name . "  ha sido ha sido seleccionada como finalista "
            . "de la feria <a href='$url_feria'>" . $feria->name . "</a>. $msje";
    if (!empty($user->email)) {
        $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
        $result1 = elgg_enviar_correo($user->email, $subject, $mensaje);
    }
    $bool = $bool & $result;
    $bool = $bool & $result1;
    $mensaje1 = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
            "</b> perteneciente al grupo " . $grupo[0]->name . " de su institución " . $institucion[0]->name .
            ", ha sido ha sido seleccionada como finalista "
            . "de la feria <a href='$url_feria'>" . $feria->name . "</a>. $msje";
    if (!empty($institucion[0]->email)) {
        $result2 = messages_send($subject, $mensaje1, $institucion[0]->owner_guid, 0, $reply);
        $result3 = elgg_enviar_correo($institucion[0]->email, $subject, $mensaje1);        
    }
    $bool = $bool & $result2;
    $bool = $bool & $result3;
}

if ($bool) {
    system_message(elgg_echo("notif:finalista:feria:ok"));
} else {
    register_error(elgg_echo("notif:finalista:feria:error"));
}

forward("/ferias/investigaciones/$id_feria#finalistas");
