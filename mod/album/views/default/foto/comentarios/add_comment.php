<?php

/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$message_content = get_input('comentario');
$owner_guid = get_input("foto");
$owner = get_entity($owner_guid);
$user = elgg_get_logged_in_user_entity();
if ($owner && !empty($message_content)) {
    $result = comentario_foto_add($user, $owner, $message_content, ACCESS_PUBLIC);
    if ($result) {
        $options = array(
            'annotation_name' => 'comentario_foto',
            'guid' => $owner_guid,
            'wheres' => " n_table.entity_guid=$owner_guid",
            'reverse_order_by' => true,
            'limit' => 1,
        );
        $mensaje = "";
        if ($user->guid != $owner->guid) {
            if ($owner->type == "group") {
                if ($owner->subtype = "grupo_investigacion") {
                    $options_integrantes = array(
                        'relationship' => 'es_miembro_de',
                        'relationship_guid' => $owner->guid,
                        'inverse_relationship' => true);
                    $entities = elgg_get_entities_from_relationship($options_integrantes);
                    foreach ($entities as $entity) {
                        if ($entity->guid != $user->guid) {
                            $site_url = elgg_get_site_url();
                            $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                            $urlGrupo = "<a href='{$site_url}grupo_investigacion/ver/{$owner->guid}'>{$owner->name}</a>";
                            $urlResult = "{$site_url}live_notifications/{$result}";
                            $mensaje = "<div id='item-notification' name='{$urlResult}' style='z-index:100'>{$urlUser} ha publicado en el muro del grupo {$owner->name}: {$message_content}</div>";
                            add_new_notification($entity->guid, $user->guid, "post", $result, $mensaje);
                        }
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

        $output = elgg_get_comentarios_foto($options, false);
        echo $output;
    } else {
        echo "error";
    }
}

