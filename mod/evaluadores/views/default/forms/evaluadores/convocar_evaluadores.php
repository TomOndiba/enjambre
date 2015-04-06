<?php

$usuario = elgg_get_logged_in_user_entity();
$guid_convocatoria= $vars['id'];
//$url = elgg_get_site_url().'evaluadore/ver/'.$guid_convocatoria;
$url1 = elgg_get_site_url() . "convocatorias/ver/".$guid_convocatoria;
$link= "<a href='$url1'>click aqui</a>";
$nombre_convocatoria = $vars['nombre_conv'];
$convocatoria = elgg_view('input/hidden', array('name' => 'guid_convocatoria', 'value' => $guid_convocatoria));
$mensaje=elgg_view('input/longtext', array('name'=>'mensaje', 'value'=>elgg_echo('inscripcion_evaluador:bodyp').' "'.$nombre_convocatoria.'"'.elgg_echo('inscripcion_evaluador:bodym'). elgg_echo('inscripcion_evaluador:url').$link));
$subject=  elgg_view('input/text', array('name'=>'subject', 'value'=>elgg_echo('inscripcion_evaluador:asunto'), 'required'=>true));        
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Enviar convocatoria')
 ));
$evaluadores = elgg_view('input/dropdown', array(
	'name' => 'recipient_guid',
	//'value' => $recipient_guid,
	'options_values' => array ('select'=>'Seleccione una Opción...','evaluadores'=>'Banco de Evaluadores'),
));

$options = array('Correo de la Comunidad' =>'0',
    'Correo Electronico' => '1',
    'Ambas Opciones' => '2');
$radio = elgg_view("input/radio", array('name' => 'metodo', 'required' => "true", 'options' => $options));

echo <<<HTML

<div>
        <label>Para: </label> $evaluadores
</div>
<div>$convocatoria
        <label>Asunto</label><br />$subject
</div>
<div>
       <label>Mensaje</label><br />$mensaje
</div>
<div>
        <label>Opciones</label><br />$radio
</div>
<div class="elgg-foot">$button</div>
HTML;
?>