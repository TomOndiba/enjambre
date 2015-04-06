<?php
$top = 100;
elgg_load_css("logged");
elgg_set_context('settings');

$user = elgg_get_logged_in_user_entity();

$objects = get_last_notifications($top);

$content = elgg_view('live_notifications/todas', array('user'=>$user, 'notifications'=>$objects));

$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
