<?php

/**
 * Elgg add friend action
 *
 * @package Elgg.Core
 * @subpackage Friends.Management
 */
// Get the GUID of the user to friend
$friend_guid = get_input('friend');
$friend = new ElggUser($friend_guid);
if (!$friend) {
    register_error(elgg_echo('error:missing_data'));
    forward(REFERER);
}

$errors = false;

// Get the user
try {
    $friend->removeRequestFriend(elgg_get_logged_in_user_guid());
    elgg_get_logged_in_user_entity()->removeRequestFriend($friend_guid);
    if (!elgg_get_logged_in_user_entity()->addFriend($friend_guid)) {
        $errors = true;
    }
    $friend->addFriend(elgg_get_logged_in_user_guid());
} catch (Exception $e) {
    register_error(elgg_echo("friends:add:failure", array($friend->name)));
    $errors = true;
}
if (!$errors) {
    // add to river
    add_to_river('river/relationship/friend/create', 'friend', elgg_get_logged_in_user_guid(), $friend_guid);
    system_message(elgg_echo("friends:add:successful", array($friend->name)));
}

// Forward back to the page you friended the user on
forward(REFERER);
