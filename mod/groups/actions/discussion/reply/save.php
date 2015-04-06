<?php
/**
 * Post a reply to discussion topic
 *
 */



// Get input
$entity_guid = (int) get_input('entity_guid');
$text = get_input('group_topic_post');
$annotation_id = (int) get_input('annotation_id');
$owner = get_entity(get_input('id'));
error_log("ANOTACIONES --> {$entity_guid} %%%% ".$owner->guid);
// reply cannot be empty
if (empty($text)) {
	register_error(elgg_echo('grouppost:nopost'));
	forward(REFERER);
}

$topic = get_entity($entity_guid);
if (!$topic) {
	register_error(elgg_echo('grouppost:nopost'));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();

$group = $topic->getContainerEntity();
if (!$group->canWriteToContainer()) {
	register_error(elgg_echo('groups:notmember'));
	forward(REFERER);
}

// if editing a reply, make sure it's valid
if ($annotation_id) {
	$annotation = elgg_get_annotation_from_id($annotation_id);
	if (!$annotation->canEdit()) {
		register_error(elgg_echo('groups:notowner'));
		forward(REFERER);
	}

	$annotation->value = $text;
	if (!$annotation->save()) {
		system_message(elgg_echo('groups:forumpost:error'));
		forward(REFERER);
	}
	system_message(elgg_echo('groups:forumpost:edited'));
} else {
	// add the reply to the forum topic
	$reply_id = $topic->annotate('group_topic_post', $text, $topic->access_id, $user->guid);
	if ($reply_id == false) {
		system_message(elgg_echo('groupspost:failure'));
		forward(REFERER);
	}

	add_to_river('river/annotation/group_topic_post/reply', 'reply', $user->guid, $topic->guid, "", 0, $reply_id);
	system_message(elgg_echo('groupspost:success'));
//        $owner = get_entity($entity_guid);
        $user = elgg_get_logged_in_user_entity();
        if ($owner) {
        error_log("INGRESA");
            $options = array(
                'annotations_name' => 'messageboard',
                'guid' => $owner->getGUID(),
                'reverse_order_by' => true,
                'limit' => 1
            );
            $mensaje = "";
            if ($user->guid != $owner->guid) {
                
                if ($owner->type == "group") {
                    
                    $subtype = $owner->getSubtype();
                    if ($subtype == "grupo_investigacion") {
                        
                        error_log("INGRESAz");
                        $objeto = "del grupo";
                        $url = "grupo_investigacion/";
                        $options_integrantes = array(
                            'relationship' => 'es_miembro_de',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
                        $entities = elgg_get_entities_from_relationship($options_integrantes);
                        error_log("SIZE -> ".sizeof($entities));
                    } else if ($subtype == "institucion") {
                        $objeto = "de la institución";
                        $url = "instituciones/";
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
                        $url = "redes_tematicas/";
                        $options_integrantes = array(
                            'relationship' => 'es_miembro_de',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
                        $entities = elgg_get_entities_from_relationship($options_integrantes);
                    }
                    foreach ($entities as $entity) {
                        if ($entity->guid != $user->guid) {
                            error_log("CREANDO " .$entity->name);
                            $site_url = elgg_get_site_url();
                            $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                            $urlResult = "{$site_url}{$url}discusiones/{$owner->guid}/view/{$entity_guid}";
                            $mensaje = "<div id='item-notification' name='{$urlResult}' style='z-index:100'>{$urlUser} ha respondido el foro $objeto <a href='{$site_url}{$url}$owner->guid'>{$owner->name}</a>: {$message_content}</div>";
                            add_new_notification($entity->guid, $user->guid, "post", $annotation_id, $mensaje);
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
        } 
        
}

forward(REFERER);
