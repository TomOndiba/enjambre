<?php

/*
 * Action que permite desvincular áreas y niveles de una feria
 */

$guid_X = get_input('id');
$guid_feria = get_input('guid');

if (check_entity_relationship($guid_feria, 'tiene_el_area', $guid_X)) {
    $remove = get_entity($guid_feria)->removeRelationship($guid_X, 'tiene_el_area');
    if ($remove) {
        system_message(elgg_echo('feria:desvincular:area:ok'), 'success');
    } else {
        register_error(elgg_echo('feria:desvincular:area:fail'));
        forward(REFERER);
    }
}
if (check_entity_relationship($guid_feria, 'tiene_el_nivel', $guid_X)) {
    $remove = get_entity($guid_feria)->removeRelationship($guid_X, 'tiene_el_nivel');
    if ($remove) {
        system_message(elgg_echo('feria:desvincular:nivel:ok'), 'success');
    } else {
        register_error(elgg_echo('feria:desvincular:nivel:fail'));
        forward(REFERER);
    }
}

forward(elgg_get_site_url() . "ferias/asociar/{$guid_feria}");
