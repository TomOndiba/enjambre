<?php

$usuario = elgg_get_logged_in_user_entity();
$guid_feria= $vars['guid_feria'];
$url = elgg_get_site_url().'feria/ver/'.$guid_feria;
$link= "<a href='$url'>click aqui</a>";
$nombre_feria = $vars['nombre_feria'];
$feria = elgg_view('input/hidden', array('name' => 'guid_feria', 'value' => $guid_feria));
$mensaje=elgg_view('input/longtext', array('name'=>'mensaje', 'value'=>elgg_echo('inscripcion_evaluador_feria:bodyp').' "'.$nombre_feria.'"'.elgg_echo('inscripcion_evaluador_feria:bodym'). elgg_echo('inscripcion_evaluador_feria:url').$link));
$subject=  elgg_view('input/text', array('name'=>'subject', 'value'=>elgg_echo('inscripcion_evaluador_feria:asunto'), 'required'=>true));        
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
        <label>Para: $evaluadores
</div>
<div>$feria
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