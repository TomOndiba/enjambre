<?php

elgg_load_css('logged');
$params = array();
$content = elgg_view('soporte/contacto', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
