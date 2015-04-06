<?php
elgg_load_js("investigaciones-evaluador-feria");
elgg_load_js("investigaciones-evaluador");
elgg_load_css("coordinacion");
elgg_load_css('reveal');
elgg_load_js('reveal2');
elgg_load_js('sumar_4.1');
elgg_load_js('sumar_4.2');
elgg_load_js('sumar_3_INV');
elgg_load_js('sumar_3_INN');
elgg_load_js('sumar2.1');
elgg_load_js('sumar_evalinfcuad');

$guid_feria=get_input('guid_feria');
$feria= new ElggFeria($guid_feria);

if($feria->tipo_feria=='Municipal'){
    $name='municipal';
    $relacion='mun';
}else if ($feria->tipo_feria=='Departamental'){
    $name='departamental';
    $relacion='dptal';
}

$title = "Evaluacion de Ferias:investigaciones asignadas";
$params = array ('guid_feria'=> $guid_feria , 'name'=> $name, 'relacion'=> $relacion);
$content= elgg_view('investigaciones_feria_asignadas/ver_investigaciones', $params);
$body = array('content' => $content);

echo elgg_view_page($title, $body, "evaluadores", array());

