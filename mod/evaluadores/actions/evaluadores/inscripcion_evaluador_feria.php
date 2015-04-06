<?php

$guid_feria = get_input('id_f');
$evaluador = get_entity(elgg_get_logged_in_user_guid());
$grupo_evaluador = elgg_get_grupo_evaluadores();

if (check_entity_relationship($evaluador->guid, 'member', $grupo_evaluador->guid)) {

    $ret = add_entity_relationship($evaluador->guid, 'preinscrito_evaluador_feria', $guid_feria);
    if ($ret) {
        system_message(elgg_echo("inscripcion_evaluador:evaluador_feria:convocatgoria:ok"), 'success');
        forward("/feria/ver/{$guid_feria}");
    } else {
        register_error(elgg_echo("inscripcion_evaluador:evaluador_feria:convocatgoria:fail"));
    }
    
} else {
    register_error(elgg_echo("inscripcion_evaluador_feria:no:miembro:grupo"));
    forward("/feria/ver/{$guid_feria}");
}

