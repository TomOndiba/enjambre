<?php

elgg_load_js('validarCampos');

$instructions = elgg_echo('evento:admin:instruct');
$guid=$vars['id'];
$tipo_input = elgg_view('input/dropdown', array('name'=>'tipo_evento', 'required'=>'true','options' => array('Feria' => 'Feria', 'Ponencia' => 'Ponencia', 'Taller'=>'Taller', 'Seminario'=>'Seminario')));
$nombre_input = elgg_view('input/text', array('name' => 'nombre_evento','required'=>'true',));
$fecha_inicio_input = elgg_view('input/date', array('id'=>'fecha_ini', 'name' => 'fecha_inicio','required'=>'true',));
$fecha_terminacion_input = elgg_view('input/date', array('id'=>'fecha_fin', 'name' => 'fecha_terminacion','required'=>'true',));
$fecha_lim_confirmacion_input = elgg_view('input/date', array('id'=>'fecha_confirm', 'name' => 'fecha_lim_confirmacion','required'=>'true',));
$lugar_input = elgg_view('input/text', array('name' => 'lugar','required'=>'true',));
$max_asistentes_input = elgg_view('input/number', array('id'=>'asistentes', 'name' => 'max_asistentes'));
$id_conv=  elgg_view('input/hidden', array('name'=>'id','value'=>$guid));


$params=array('name'=>'objetivo', 'required'=>'true');
$objetivo_input = elgg_view('eventos/textarea', $params);
$params1=array('name'=>'dirigido_a', 'required'=>'true');
$dirigido_a_input = elgg_view('eventos/textarea', $params1);
$params2=array('name'=>'requisitos', 'required'=>'false');
$requisitos = elgg_view('eventos/textarea', $params2);

$button = elgg_view('input/submit', array('id'=>'aceptar','value' => elgg_echo('Aceptar')));

$url=elgg_get_site_url();
$url1= $url."eventos/listado/$guid";

echo <<<HTML

<h2> Nuevo Evento  </h2>
<div id="dialogo" title="Fecha inválida">
  <p>
<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div><br>$instructions</div>
<div>
    <label>Tipo de evento:</label><br>$tipo_input $id_conv
</div>
<div>
    <label>Nombre(*):</label><br />$nombre_input
</div>
<div>
    <label>Fecha de inicio(*):</label><br />$fecha_inicio_input
</div>
<div>
    <label>Fecha de terminación(*):</label><br />$fecha_terminacion_input
</div>
<div>
    <label>Fecha límite de confirmación(*):</label><br />$fecha_lim_confirmacion_input
</div>
<div>
    <label>Lugar(*):</label><br />$lugar_input
</div>
<div>
    <label>Número máximo de asistentes:</label><br />$max_asistentes_input
</div>
    <input type="hidden" name="grupo" value="{$guid}"/>    
<div>
    <label>Objetivo(*):</label><br><br>
    $objetivo_input
</div>
<div>
    <label>Dirigido a(*):</label><br><br>
    $dirigido_a_input
</div>
<div>
    <label>Requisitos:</label><br><br>
    $requisitos
</div>
<div class="contenedor-button">
$button
<a class='link-button' href='$url1'><b>Cancelar</b></a>
</div>
HTML;
?>
