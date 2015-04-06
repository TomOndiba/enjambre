<?php

$instructions = elgg_echo('rol:intruccion:crear');


$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre_rol',
    'required'=>'true',
        ));

$descripcion_input = elgg_view('input/longtext', array(
    'name' => 'descripcion',
        ));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Registrar')
        ));

echo <<<HTML
<div>$instructions</div>

<div>
    <label>Nombre</label>$nombre_input
</div>
<div>
    <label>Descripcion</label>$descripcion_input
</div>
        
<div class="elgg-foot">
$button
</div>
HTML;
