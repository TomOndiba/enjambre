<?php

elgg_load_css('logged');
$title = "Editar Red Tematica";

$guid = get_input('id'); //id del grupo
$red = get_entity($guid);


$form_vars = array(
    'enctype' => 'multipart/form-data',
    'class' => 'elgg-form-alt',
);


if ($red && $red->canEdit()) {
    elgg_set_page_owner_guid($red->getGUID());
    elgg_push_breadcrumb($red->name, $red->getURL());
    elgg_push_breadcrumb($title);
    $content = elgg_view("redes_tematicas/edit", array('entity' => $red));
} else {
    $content = elgg_echo('groups:noaccess');
}



$params = array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
);


$body = array('izquierda' => elgg_view('redes_tematicas/profile/menu', array('red' => $red)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('red' => $red));
