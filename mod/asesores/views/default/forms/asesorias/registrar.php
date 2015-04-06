<?php

$id_conv = $vars['id_conv'];
$id_inv = $vars['id_inv'];
$nombre_txt = elgg_echo('Nombre de la actividad');
$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => true,
        ));
$tipo_txt = elgg_echo('Tipo de actividad:');
$tipo_input = elgg_view('input/text', array(
    'name' => 'tipo',
    'required' => true,
        ));
$fecha_txt = elgg_echo('Fecha de la actividad:');

$fecha_input = "<input type='date' name='fecha'  require='true'>";

$hora_txt = elgg_echo('Hora de la actividad:');
$hora_input = elgg_view('input/dropdown', array('name'=>'hora', 'required'=>'true','options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', 
                                                '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', 
                                                '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_input = elgg_view('input/dropdown', array('name'=>'minutos', 'required'=>'true','options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));

$modo_txt = elgg_echo('Modalidad:');
$modo_input = elgg_view('input/dropdown', array('name' => 'modo', 'options_values' => array(
        'Presencial' => 'Presencial',
        'Online' => 'Online'),
        ));
$observaciones_txt = elgg_echo('Observaciones:');
$observaciones_input = elgg_view('input/longtext', array(
    'name' => 'observaciones',
    'required' => true,
    'style'=>'height:50px',
        ));


$conv_input = elgg_view('input/hidden', array('name' => 'id_conv', 'value' => $id_conv));
$inv_input = elgg_view('input/hidden', array('name' => 'id_inv', 'value' => $id_inv));
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Registrar'),
        ));

echo <<<HTML

<div><label>$nombre_txt</label>$nombre_input</div>
<div><label>$fecha_txt</label>$fecha_input</div>
<div><label>$hora_txt</label>$hora_input : $minutos_input
<div><label>$tipo_txt</label>$tipo_input</div>
<div><label>$modo_txt</label>$modo_input</div>
<div><label>$observaciones_txt</label>$observaciones_input</div>

<div class="contenedor-button">
$conv_input
$inv_input
$button
</div>
HTML;

