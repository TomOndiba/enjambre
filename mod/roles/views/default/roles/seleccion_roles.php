<?php

$roles = elgg_get_list_roles();
$opt_roles = array();
foreach ($roles as $rol) {
    $opt_roles[$rol['guid']] = '&nbsp&nbsp'.$rol['nombre'].'&nbsp&nbsp';
};
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Asignar'),
    'id' => "asignarrol"
        ));

$seleccion_rol_input = elgg_view('input/dropdown', array(
    'name' => 'id_rol',
    'options_values' => $opt_roles,
    'id'=>'select_rol'
        ));

echo <<<HTML
<div align='center'>
<br><hr>
<div>
    <label>Seleccione el rol&nbsp&nbsp&nbsp</label>$seleccion_rol_input&nbsp&nbsp&nbsp&nbsp$button
        </div>
</div>
HTML;
