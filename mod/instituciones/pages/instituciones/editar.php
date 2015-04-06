<?php

elgg_load_css('logged');
$guid = get_input('guid');

$title = "";
$user = elgg_get_logged_in_user_entity();

$inst = get_entity($guid);

$munic = mb_strtolower($inst->municipio, "UTF-8");
$municipio = ucfirst($munic);

$params = array('guid' => $guid, 'nombre' => $inst->name, 'direccion' => $inst->direccion, 'telefono' => $inst->telefono,
    'director' => $inst->director, 'email' => $inst->email, 'website' => $inst->website, 'departamento' => $inst->departamento,
    'municipio' => $municipio, 'corregimiento' => $inst->corregimiento, 'tipo_inst' => $inst->tipo_institucion);
$form_vars = array(
    'enctype' => 'multipart/form-data',
    'class' => 'elgg-form-alt',
);

$content .= elgg_view_form('instituciones/edit', $form_vars, $params);
$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$inst)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$inst)); 

