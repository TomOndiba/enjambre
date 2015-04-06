<?php

/**
 * Page que prepara las variables  y redirecciona a la Vista de edición de un Grupo de Investigación
 */
elgg_load_css('logged');

$title = "Editar Grupo de Investigación";

$guid = get_input('id'); //id del grupo
$group = get_entity($guid);


$form_vars = array(
    'enctype' => 'multipart/form-data',
    'class' => 'elgg-form-alt',
);


if ($group && $group->canEdit()) {
    elgg_set_page_owner_guid($group->getGUID());
    elgg_push_breadcrumb($group->name, $group->getURL());
    elgg_push_breadcrumb($title);
    $content = elgg_view("grupo_investigacion/edit", array('entity' => $group));
} else {
    $content = elgg_echo('groups:noaccess');
}



$params = array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
);




$body = array('izquierda' => elgg_view('grupo_investigacion/profile/menu', array('grupo' => $group)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('grupo' => $group));


