<?php

elgg_load_js('validarCampos');

$guid=$vars['id'];

$id_conv= $vars['id_conv'];
$nombre_evento= $vars['nombre'];
$fecha_inicio= $vars['fecha_inicio'];
$tipo_evento= $vars['tipo_evento'];
$fecha_terminacion= $vars['fecha_terminacion'];
$fecha_limite_confirmacion= $vars['fecha_lim_confirmacion'];
$lugar= $vars['lugar'];
$max_asistentes = $vars['max_asistentes'];
$objetivo=$vars['objetivo'];
$dirigido_a=$vars['dirigido_a'];
$requisitos=$vars['requisitos'];

$tipo_input = elgg_view('input/dropdown', array('name'=>'tipo_evento', 'required'=>'true','options' => array('Feria' => 'Feria', 'Ponencia' => 'Ponencia', 'Taller'=>'Taller', 'Seminario'=>'Seminario'), 'value'=> $tipo_evento));
$nombre_input = elgg_view('input/text', array('name' => 'nombre_evento','required'=>'true', 'value'=> $nombre_evento));
$fecha_inicio_input = elgg_view('input/date', array('id'=>'fecha_ini', 'name' => 'fecha_inicio','required'=>'true', 'value'=> $fecha_inicio));
$fecha_terminacion_input = elgg_view('input/date', array('id'=>'fecha_fin', 'name' => 'fecha_terminacion','required'=>'true', 'value'=> $fecha_terminacion));
$fecha_lim_confirmacion_input = elgg_view('input/date', array('id'=>'fecha_confirm', 'name' => 'fecha_lim_confirmacion','required'=>'true', 'value'=> $fecha_limite_confirmacion));
$lugar_input = elgg_view('input/text', array('name' => 'lugar','required'=>'true', 'value'=> $lugar));
$max_asistentes_input = elgg_view('input/text', array('id'=>'asistentes', 'name' => 'max_asistentes', 'value'=> $max_asistentes));
$id_conv_input=  elgg_view('input/hidden', array('name'=>'id_conv','value'=>$id_conv));
$id_evento_input=  elgg_view('input/hidden', array('name'=>'id_evento','value'=>$guid));


$params=array('name'=>'objetivo', 'required'=>'true','value'=>$objetivo);
$objetivo_input = elgg_view('eventos/textarea', $params);
$params1=array('name'=>'dirigido_a', 'required'=>'true','value'=>$dirigido_a);
$dirigido_a_input = elgg_view('eventos/textarea', $params1);
$params2=array('name'=>'requisitos', 'required'=>'false','value'=>$requisitos);
$requisitos_input = elgg_view('eventos/textarea', $params2);

$button = elgg_view('input/submit', array('id'=>'aceptar','value' => elgg_echo('Guardar Cambios')));

$url=elgg_get_site_url();
$url1= $url."eventos/listado/$id_conv";

echo <<<HTML
<div id="dialogo" title="Fecha inválida">
  <p>
<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Ejemplo de cuadro de diálogo, pon aquí tu aviso</p>
</div>
<div>
    <label>Tipo de evento:</label><br>$tipo_input $id_conv_input $id_evento_input
</div>
<div>
    <label>Nombre(*)</label><br />$nombre_input
</div>
<div>
    <label>Fecha de inicio(*)</label><br />$fecha_inicio_input
</div>
<div>
    <label>Fecha de terminación(*)</label><br />$fecha_terminacion_input
</div>
<div>
    <label>Fecha límite de confirmación(*)</label><br />$fecha_lim_confirmacion_input
</div>
<div>
    <label>Lugar(*)</label><br />$lugar_input
</div>
<div>
    <label>Número máximo de asistentes:</label><br />$max_asistentes_input
</div>
<div>
    <label>Objetivo(*)</label><br />
    $objetivo_input
</div>
<div>
    <label>Dirigido a(*)</label><br />
    $dirigido_a_input
</div>
<div>
    <label>Requisitos</label><br />
    $requisitos_input
</div>
<div class="elgg-foot" align="center">
$button &nbsp;&nbsp;&nbsp;&nbsp;
<a class='link-button' href='$url1'><b>Cancelar</b></a>
</div>
HTML;
?>
