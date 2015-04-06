<?php

$id = get_input('id');
$select = elgg_view('input/dropdown', array(
    'name' => 'id_rol',
    'options_values' => array('admin' => elgg_echo('grupo_investigacion:select:admin'),
        'editar' => elgg_echo('grupo_investigacion:select:editar'),
        'leer' => elgg_echo('grupo_investigacion:select:leer')
    ),
    'id' => 'select-'.$id,
        ));
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Asignar'),
    'id' => "asignar-rol-grupo",
    'name'=>$id,
        ));

echo <<<HTML
$select &nbsp;&nbsp;&nbsp $button
HTML;

