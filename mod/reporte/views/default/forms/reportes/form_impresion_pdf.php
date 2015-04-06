<?php

$header=  json_encode($vars['header']);
$data=json_encode($vars['data']);
$ancho=json_encode($vars['ancho']);

$titulo=elgg_view('input/hidden', array('name'=>"titulo", 'value'=>$vars['titulo']));
$header=elgg_view('input/hidden', array('name'=>"header", 'value'=>$header));
$width=elgg_view('input/hidden', array('name'=>"ancho", 'value'=>$ancho));
$data=elgg_view('input/hidden', array('name'=>"data", 'value'=>$data));
$bit=elgg_view('input/hidden', array('name'=>"bit", 'value'=>'102'));

$button = elgg_view('input/submit', array('id' => 'Agregar', 'value' => 'Imprimir PDF'));

echo $titulo.$header.$data.$bit.$width;

echo "<div class='contenedor-button'>$button </div>";

?>

