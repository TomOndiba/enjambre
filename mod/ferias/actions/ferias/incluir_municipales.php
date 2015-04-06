<?php

$ferias_municipales = get_input('ferias_municipales'); //ferias municipales seleccionadas
$id_feria = get_input('id_feria'); //feria departamental
$feria_dptal = new ElggFeria($id_feria);
$user = elgg_get_logged_in_user_entity();

$bool = true;

foreach ($ferias_municipales as $feria) {

    $feria_mpal = new ElggFeria($feria);
    if ($feria_mpal->addRelationship($id_feria, "incluida_en")) {
        create_metadata($feria, 'participo_en_departamental', 'true', 'text', $user->guid, ACCESS_PUBLIC);
        $url_feria = elgg_get_site_url() . "ferias/detalles/$id_feria";

        $inv_finalistas = elgg_get_relationship_inversa($feria_mpal, "finalista_en");
        foreach ($inv_finalistas as $investigacion) {
            //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la selección de la investigacion
            $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
            $user = elgg_get_usuario_byId($grupo[0]->owner_guid);
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
            $user1 = elgg_get_usuario_byId($institucion[0]->owner_guid);
            $url_inscripcion = elgg_get_site_url() . "ferias/inscripcion/{$investigacion->guid}/{$grupo[0]->guid}/$id_feria";

            $subject = "Invitación a Feria Departamental";
            $mensaje = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
                    "</b> perteneciente a su grupo " . $grupo[0]->name . " ha sido ha incluida dentro de las investigaciones invitadas"
                    . " a la nueva feria departamental <a href='$url_feria'>" . $feria_dptal->name . "</a>."
                    . " Debe realizar su respectiva inscripción en las fechas establecidas pulsando <a href='$url_inscripcion'>aquí</a>.";
            $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
            if (!empty($user->email)) {
                $result1 = elgg_enviar_correo($user->email, $subject, $mensaje);
            }
            $bool = $bool & $result;

            $bool = $bool & $result1;


            $mensaje1 = " Cordial Saludo, Nos permitimos informarle que la Investigación <b>" . $investigacion->name .
                    "</b> perteneciente al grupo " . $grupo[0]->name . " de su institución " . $institucion[0]->name .
                    ", ha sido ha incluida dentro de las investigaciones invitadas"
                    . " a la nueva feria departamental <a href='$url_feria'>" . $feria_dptal->name . "</a>."
                    . " Debe realizar su respectiva inscripción en las fechas establecidas pulsando <a href='$url_inscripcion'>aquí</a>.";
            $result2 = messages_send($subject, $mensaje1, $institucion[0]->owner_guid, 0, $reply);
            if (!empty($institucion[0]->email)) {
                $result3 = elgg_enviar_correo($institucion[0]->email, $subject, $mensaje1);                
            }
            $bool = $bool & $result2;

            $bool = $bool & $result3;
        }
    } else {
        $bool = false;
    }
}

if ($bool) {
    system_message(elgg_echo("inclusion:feria:ok"));
    forward("/ferias/detalles/$id_feria");
} else {
    register_error(elgg_echo("inclusion:feria:error"));
    forward(REFERER);
}

