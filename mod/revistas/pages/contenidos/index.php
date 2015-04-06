<?php

$title = "Contenidos Digitales";
$params = array();
if (elgg_get_logged_in_user_guid()) {
	error_log("fail");
    elgg_load_css('logged');
    $content = elgg_view('contenidos/index', $params);
    $body = array('content' => $content);
    echo elgg_view_page($title, $body, "lista", array());
}else {
	error_log("good");
    elgg_load_js('reveal');
    elgg_load_css('inicio');
    echo elgg_view_page($title, $body, "contenidos", array());
}
