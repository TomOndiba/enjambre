<?php
elgg_load_css("logged");

$guid= get_input("id_mensaje");
$content = elgg_view('mensajes/ver_mensaje', array('mensaje'=>get_entity($guid)));
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());