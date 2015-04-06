<?php
/**
 * Page for resetting a forgotten password
 *
 * @package Elgg.Core
 * @subpackage Registration
 */

if (elgg_is_logged_in()) {
	forward();
}
elgg_load_css("inicio");
$user_guid = get_input('u');
$code = get_input('c');

$user = get_entity($user_guid);

// don't check code here to avoid automated attacks
if (!$user instanceof ElggUser) {
	register_error(elgg_echo('user:passwordreset:unknown_user'));
	forward();
}

$params = array(
	'guid' => $user_guid,
	'code' => $code,
);
$form = elgg_view_form('user/passwordreset', array('class' => 'elgg-form-account'), $params);


$content =$form;

$body = array('content' => $content);
echo elgg_view_page($title, $body, "registro", array());


