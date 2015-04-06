<?php
$guid_convocatoria = $vars['guid_conv'];
$guid_investigacion = $vars['investigacion'];

$asunto = elgg_view('input/text', array('name' => 'asunto','required'=>'true', 'value'=>'','placeholder'=>'Digite el asunto'));
$conv = elgg_view('input/hidden', array('name' => 'guid_conv','required'=>'true', 'value'=>$guid_convocatoria,));
$bit = elgg_view('input/hidden', array('name' => 'bit','required'=>'true', 'value'=>91,));
$inv = elgg_view('input/hidden', array('name' => 'guid_inv','required'=>'true', 'value'=>$guid_investigacion,));
 
//$url1 = elgg_get_site_url() . "action/bitacoras/print?guid_conv=" . $guid_convocatoria . '&bit=91&guid_inv='.$guid_investigacion;
//$url_print = elgg_add_action_tokens_to_url($url1);

$button = elgg_view('input/submit', array('id'=>'aceptar','value' => elgg_echo('Aceptar')));
// $button = "<a href='$url_print'>Aceptar</a>";
echo <<<HTML
<div>
<label>Asuto</label>$asunto
</div>
$conv
$bit
$inv
<br>
<div>
<label>Mensaje</label><textarea name='mensaje' placeholder='Digite aquí su mensaje...'></textarea><br>
$button

HTML;

?>