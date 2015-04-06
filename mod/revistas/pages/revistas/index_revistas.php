<?php

$title = "Revistas";
$params = array();
if (elgg_get_logged_in_user_guid()) {
    elgg_load_css('logged');
    $content = elgg_view('revistas/listar_revistas', $params);
    $body = array('content' => $content);
    echo elgg_view_page($title, $body, "lista", array());
} else {
    elgg_load_js('reveal');
    elgg_load_js('pag_revistas_2');
    elgg_load_css('inicio');
    echo elgg_view_page($title, $body, "revistas", array());
}
