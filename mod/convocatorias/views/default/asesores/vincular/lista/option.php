<?php

elgg_load_js('confirmacion_feria');

$guid = $vars['guid'];
$guid_convocatoria = $vars['guid_convocatoria'];
$lista;

$lista.= "<a id='evaluar' title='$guid'>Evaluar</a>";

echo <<<HTML
    $lista

HTML;

