<?php

$user = elgg_get_logged_in_user_entity();
$guid_convocatoria = get_input("guid");
if (!elgg_es_asesor($user->guid)) {
    system_message(elgg_echo("asesor:inscripcion:noasesor"), 'error');
} else {
    $incripcion = $user->addRelationship($guid_convocatoria, "inscripcion_asesor");
    if ($incripcion) {
        system_message(elgg_echo("asesor:inscripcion:exitoso"), 'success');
    }
    else{
        system_message(elgg_echo("asesor:inscripcion:error"), 'error');
    }
}
forward(REFERER);