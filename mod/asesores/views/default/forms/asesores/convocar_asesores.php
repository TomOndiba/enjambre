<?php

$usuario = elgg_get_logged_in_user_entity();
$guid_convocatoria = $vars['id'];
$convocatoria = elgg_view('input/hidden', array('name' => 'guid_convocatoria', 'value' => $guid_convocatoria));
$con = new ElggConvocatoria($guid_convocatoria);
$url = elgg_get_site_url() . "convocatorias/ver/{$con->guid}";
$link = "<a href='$url'>has click aqui</a>";
$mensaje = elgg_view('input/longtext', array('name' => 'mensaje', 'value' => elgg_echo("default:asesores:convocatoria", array($con->name, $link))));
$subject = elgg_view('input/text', array('name' => 'subject', 'value' => 'Invitación a convocatoria de Asesores', 'required' => "true"));
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Enviar convocatoria')
        ));
$options = array('Correo de la Comunidad' =>'0',
    'Correo Electronico' => '1',
    'Ambas Opciones' => '2');
$radio = elgg_view("input/radio", array('name' => 'metodo', 'required' => "true", 'options' => $options));
echo <<<HTML
<div>$convocatoria
        <label>Asunto</label><br />$subject
</div>
<div>
       <label>Mensaje</label><br />$mensaje
</div>
        <div>
       <label>Seleccione un Metodo de Notificacion</label><br />$radio
</div>
<div class="elgg-foot">$button</div>
HTML;
?>
