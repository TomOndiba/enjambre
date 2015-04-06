<?php



elgg_load_css('logged');

gatekeeper();

$user = elgg_get_logged_in_user_entity();
if (!$user) {
	register_error(elgg_echo("profile:notfound"));
	forward();
}





// check if logged in user can edit this profile
if (!$user->canEdit()) {
	register_error(elgg_echo("profile:noaccess"));
	forward();
}


$params = array('entity' => $user);    
$content = elgg_view_form('usuario/cambiar_password', null, $params);

$body = array('izquierda' => elgg_view('profile/menu', array('user' => $user)), 'derecha' => $content);

echo elgg_view_page($user->name, $body, "profile", array('user' => $user));