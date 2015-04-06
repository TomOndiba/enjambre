<?php

/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$message_content = get_input('message_content');
$owner_guid = get_input("owner_guid");
$owner = get_entity($owner_guid);
$user = elgg_get_logged_in_user_entity();
if ($owner && !empty($message_content)) {
    $result = messageboard_add($user, $owner, $message_content, ACCESS_PUBLIC);
    if ($result) {
        system_message(elgg_echo("messageboard:posted"));
        $options = array(
            'annotations_name' => 'messageboard',
            'guid' => $owner->getGUID(),
            'reverse_order_by' => true,
            'limit' => 1
        );
        $mensaje = "";
        if ($user->guid != $owner->guid) {
            if ($owner->type == "group") {
                $subtype= $owner->getSubtype();
                if ($subtype == "grupo_investigacion") {
                    $objeto = "del grupo";
                    $url="grupo_investigacion/ver/";
                    $options_integrantes = array(
                        'relationship' => 'es_miembro_de',
                        'relationship_guid' => $owner->guid,
                        'inverse_relationship' => true);
                    $entities = elgg_get_entities_from_relationship($options_integrantes);
                } else if ($subtype == "institucion") {
                    $objeto = "de la institución";
                    $url="instituciones/ver/";
                    $options_integrantes = array(
                        'relationship' => 'estudia_en',
                        'relationship_guid' => $owner->guid,
                        'inverse_relationship' => true);
                    $estudiantes = elgg_get_entities_from_relationship($options_integrantes);
                    $options_integrantes = array(
                        'relationship' => 'trabaja_en',
                        'relationship_guid' => $owner->guid,
                        'inverse_relationship' => true);
                    $profesor = elgg_get_entities_from_relationship($options_integrantes);
                    $entities = array_merge($estudiantes, $profesor);
                } else if ($subtype == "red_tematica") {
                    $objeto = "de la red temática";
                    $url="redes_tematicas/ver/";
                    $options_integrantes = array(
                        'relationship' => 'es_miembro_de',
                        'relationship_guid' => $owner->guid,
                        'inverse_relationship' => true);
                    $entities = elgg_get_entities_from_relationship($options_integrantes);
                }
                foreach ($entities as $entity) {
                    if ($entity->guid != $user->guid) {
                        $site_url = elgg_get_site_url();
                        $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                        $urlResult = "{$site_url}live_notifications/{$result}";
                        $mensaje = "<div id='item-notification' name='{$urlResult}' style='z-index:100'>{$urlUser} ha publicado en el muro $objeto <a href='{$site_url}{$url}$owner->guid'>{$owner->name}</a>: {$message_content}</div>";
                        add_new_notification($entity->guid, $user->guid, "post", $result, $mensaje);
                    }
                }
            } else {
                $site_url = elgg_get_site_url();
                $urlResult = "{$site_url}live_notifications/{$result}";
                $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                $mensaje = "<div id='item-notification' name='{$urlResult}'>{$urlUser} ha publicado tú muro: {$message_content}</div>";
                add_new_notification($owner->guid, $user->guid, "post", $result, $mensaje);
            }
        }

        $output = elgg_get_messageboard_grupo_investigacion($options, false);
        echo $output;
    } else {
        echo "error";
    }
}

