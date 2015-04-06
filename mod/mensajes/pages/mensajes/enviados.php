<?php
elgg_load_css("logged");
$guid=  elgg_get_logged_in_user_entity()->guid;
$content = elgg_view('mensajes/enviados', array());
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());