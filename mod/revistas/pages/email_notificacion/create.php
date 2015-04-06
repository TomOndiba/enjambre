<?php

$title = "Notificaciones por email";
$params = array();
elgg_load_css('logged');
$content = elgg_view('email_notificacion/create', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());

?>
