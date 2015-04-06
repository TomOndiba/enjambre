<?php

elgg_load_library('elgg:webinar');
$guid = get_input('owner');
$guid_inv = get_input('investigacion');
$guid_asesoria = get_input('asesoria');

if (!$guid) {
    $container = elgg_get_logged_in_user_entity();
} else {
    $container = get_entity($guid);
    if (!$container->canEdit()) {
        register_error(elgg_echo('webinar:error:cannot_edit'));
        forward($container->getURL());
    }
}

$body_vars = webinar_prepare_form_vars(null, $guid_inv, $guid_asesoria);
$plugin = elgg_get_calling_webinar_entity();
$body_vars['server_salt'] = $plugin->server_salt;
$body_vars['server_url'] =$plugin->server_url;
$body_vars['logout_url' ] =null;
$body_vars['admin_pwd' ] =$plugin->admin_pwd;
$body_vars['user_pwd' ] = $plugin->user_pwd;
 $content = elgg_view_form('webinar/save', array(), $body_vars);
echo $content;
