<?php

elgg_load_css('logged');
$guid_webinar= get_input('guid');

$params=array("guid"=>$guid_webinar);
$content = elgg_view('asesorias/ver_webinar_invitado', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "entrar_webinar", array());
