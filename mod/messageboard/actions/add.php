<?php

/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$message_content = get_input('message_content');
$owner_guid = get_input("owner_guid");
$owner = get_entity($owner_guid);

if ($owner && !empty($message_content)) {
    $result = messageboard_add(elgg_get_logged_in_user_entity(), $owner, $message_content, ACCESS_PUBLIC);
    if ($result) {
        system_message(elgg_echo("messageboard:posted"));
        $options = array(
            'annotations_name' => 'messageboard',
            'guid' => $owner->getGUID(),
            'reverse_order_by' => true,
            'limit' => 1
        );
        $output = elgg_get_messageboard_grupo_investigacion($options, false);
        //echo $output;
    } else {
        echo "error";
    }
}

