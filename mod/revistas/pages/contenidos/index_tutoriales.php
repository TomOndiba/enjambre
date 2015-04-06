<?php

$title = "Contenidos Digitales";
$params = array();
if (elgg_get_logged_in_user_guid()) {
    elgg_load_css('logged');
    $content = elgg_view('contenidos/index_tutoriales', $params);
    $body = array('content' => $content);
    echo elgg_view_page($title, $body, "lista", array());
} else {
    elgg_load_js('reveal');
    elgg_load_css('inicio');
    echo elgg_view_page($title, $body, "tutoriales", array());
}
