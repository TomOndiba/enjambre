<?php

$user = get_entity(get_input('guid'));

$group = elgg_get_grupo_asesores();

add_entity_relationship($user->guid, 'membership_request', $group->guid);

// Notify group owner
$url = "{$CONFIG->url}groups/requests/$group->guid";
$subject = elgg_echo('groups:request:subject', array(
    $user->name,
    $group->name,
        ));
$body = elgg_echo('groups:request:body', array(
    $group->getOwnerEntity()->name,
    $user->name,
    $group->name,
    $user->getURL(),
    $url,
        ));
if (notify_user($group->owner_guid, $user->getGUID(), $subject, $body)) {
    system_message(elgg_echo("groups:joinrequestmade"));
} else {
    register_error(elgg_echo("groups:joinrequestnotmade"));
}



$lineas = get_input('lineas');
foreach ($lineas as $linea) {
    add_entity_relationship($user->guid, "asesor_de_linea", $linea);
}