<?php
/**
 * Elgg login action
 *
 * @package Elgg.Core
 * @subpackage User.Authentication
 */


	// forward to main index page
$forward_url = '';
$username = get_input('username');
$password = get_input('password', null, false);
error_log($username."-"."$password");
$persistent = (bool) get_input("persistent");
$result = false;

if (empty($username) || empty($password)) {
	register_error(elgg_echo('login:empty'));
	forward();
}

// check if logging in with email address
if (strpos($username, '@') !== false && ($users = get_user_by_email($username))) {
	$username = $users[0]->username;
}
$user = get_user_by_username($username);
error_log("Username:".$user->username."--"."pass creado:".$user->password."--pass_generado:".  md5($password));
$result = ($user->password==md5($password));
if ($result !== true) {
	register_error("El nombre de usuario y la contraseña no coinciden");
	forward(REFERER);
}

if (!$user) {
	register_error(elgg_echo('login:baduser'));
	forward(REFERER);
}
try {
	login($user, $persistent);
	// re-register at least the core language file for users with language other than site default
	register_translations(dirname(dirname(__FILE__)) . "/languages/");
} catch (LoginException $e) {
	register_error($e->getMessage());
	forward(REFERER);
}

// elgg_echo() caches the language and does not provide a way to change the language.
// @todo we need to use the config object to store this so that the current language
// can be changed. Refs #4171
if ($user->language) {
	$message = elgg_echo('loginok', array(), $user->language);
} else {
	$message = elgg_echo('loginok');
}

if (isset($_SESSION['last_forward_from'])) {
	unset($_SESSION['last_forward_from']);
}

system_message($message);
forward(REFERER);
