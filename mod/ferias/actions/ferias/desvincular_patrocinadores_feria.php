<?php

/*
 * Action que permite desvincular patrocinadores de una feria
 */

$guid_X = get_input('id');
$guid_feria = get_input('guid');

if (check_entity_relationship($guid_feria, 'tiene_el_patrocinador', $guid_X)) {
    $remove = get_entity($guid_feria)->removeRelationship($guid_X, 'tiene_el_patrocinador');
    if ($remove) {
        system_message(elgg_echo('patrocinadores:desvincular:area:ok'), 'success');
    } else {
        register_error(elgg_echo('patrocinadores:desvincular:area:fail'));
        forward(REFERER);
    }
}

forward(elgg_get_site_url() . "ferias/asociar_patro/{$guid_feria}");


