<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$grupo=$vars['grupo'];
$investigacion=$vars['investigacion'];
$value=$vars['value'];

$categorias = elgg_view('input/radio', array('options' => array('Innovación' => 'Innovación', 'Investigación' => 'Investigación'),'name' => 'categoria', 'value'=>$value));
$grupo_input=  elgg_view('input/hidden', array('name'=>'grupo','value'=>$grupo));
$inv_input=  elgg_view('input/hidden', array('name'=>'investigacion','value'=>$investigacion));
$button = elgg_view('input/submit', array('id'=>'aceptar', 'value' => elgg_echo('Aceptar')));

echo <<<HTML
<div class="box contet-grupo-investigacion">
    <h2 class="title-legend">Categoría</h2>
        <br><br>Seleccione la categoría a la cuál pertenece la investigación: 
    <br><br>$categorias $grupo_input  $inv_input
        <br>
    $button
</div>
HTML;

?>