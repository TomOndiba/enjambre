<?php

$guid_convocatoria = get_input('id_conv');
$evaluador = get_entity(elgg_get_logged_in_user_guid());
$grupo_evaluador = elgg_get_grupo_evaluadores();

if (check_entity_relationship($evaluador->guid, 'member', $grupo_evaluador->guid)) {

    $ret = add_entity_relationship($evaluador->guid, 'preinscrito_evaluador_convocatoria', $guid_convocatoria);
    if ($ret) {
        system_message(elgg_echo("inscripcion_evaluador:evaluador:convocatgoria:ok"), 'success');
    forward(elgg_get_site_url()."convocatorias/ver/".$guid_convocatoria);
    } else {
        register_error(elgg_echo("inscripcion_evaluador:evaluador:convocatgoria:fail"));
    }
    
} else {
    register_error(elgg_echo("inscripcion_evaluador:no:miembro:grupo"));
    forward(elgg_get_site_url());
}