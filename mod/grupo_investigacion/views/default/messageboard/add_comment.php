<?php

/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$message_content = get_input('message_content');
$owner_guid = get_input("owner_guid");
$owner = new ElggAnnotation($owner_guid);
$user = elgg_get_logged_in_user_entity();
if ($owner && !empty($message_content)) {
    $result = add_messageboard_comment($user, $owner, $message_content, ACCESS_PUBLIC);
    if ($result) {
        $query = array(
            'annotation_name' => 'comment_messageboard',
            'reverse_order_by' => true,
            'limit' => 1,
            'wheres' => " n_table.entity_guid=$owner->id "
        );
        $poster = $owner->owner_guid;
        $m = $owner->entity_guid;
        $muro = get_entity($m);
       
        if ($user->guid != $poster) {
            $site_url = elgg_get_site_url();
            $urlResult = "{$site_url}live_notifications/{$owner_guid}";
            $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
            $urlMuro = "<a href='{$site_url}profile/{$muro->username}'>{$muro->name}</a>";
            $mensaje = "<div id='item-notification' name='{$urlResult}' style='z-index:100'>{$urlUser} ha comentado tú publicación en el muro de {$urlMuro}: {$message_content}</div>";
            add_new_notification($poster, $user->guid, "post", $result, $mensaje);
        }
        $options = array('query' => $query, 'view' => 'messageboard/comment/ver_comentarios');
        echo $output = elgg_get_comments_post($options);
    }
} else {
    
}

