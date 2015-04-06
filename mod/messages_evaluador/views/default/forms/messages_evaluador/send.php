<?php
/**
 * Formulario donde se llena el contenido del mensaje y se cargan las opciones de envío.
 * 
 * @author DIEGOX_CORTEX
 * @uses $vars['friends']
 */

$recipient_guid = elgg_extract('recipient_guid', $vars, 0);
$subject = elgg_extract('subject', $vars, '');
$body = elgg_extract('body', $vars, '');

$evaluadores = $vars['friends'];
$nombre_convocatoria = $vars['nombre_convocatoria'];
$url = $vars['url'];

$revalua = "";
$recipients_options = array();
foreach ($evaluadores as $friend) {
	//$recipients_options[$friend->guid] = $friend->name;
        $revalua .=$friend->guid.',';
        
}

if (!array_key_exists($recipient_guid, $recipients_options)) {
	$recipient = get_entity($recipient_guid);
	if (elgg_instanceof($recipient, 'user')) {
		$recipients_options[$recipient_guid] = $recipient->name;
	}
}

$recipient_drop_down = elgg_view('input/dropdown', array(
	'name' => 'recipient_guid',
	//'value' => $recipient_guid,
	'options_values' => array ('select'=>'Seleccione una Opción...','evaluadores'=>'Banco de Evaluadores'),
));



$revaluadores = elgg_view('input/hidden', array(
	'name' => 'revaluadores',
	'value' => $revalua,
));


?>
<div>
	<label><?php echo elgg_echo("messages_evaluador:to"); ?>: </label>
	<?php echo $recipient_drop_down; ?>
        <?php echo $revaluadores; ?>
</div>
<div>
	<label><?php echo elgg_echo("messages_evaluador:title"); ?>: <br /></label>
	<?php echo elgg_view('input/text', array(
		'name' => 'subject',
		'value' => elgg_echo('messages_evaluador:asunto'),
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo("messages_evaluador:message"); ?>:</label>
	<?php echo elgg_view("input/longtext", array(
		'name' => 'body',
		'value' => elgg_echo('messages_evaluador:bodyp').' "'.$nombre_convocatoria.'"'.elgg_echo('messages_evaluador:bodym'). elgg_echo('messages_evaluador:url').$url.elgg_echo('messages_evaluador:bodyf'),
	));
	?>
</div>
<div class="elgg-foot">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('messages_evaluador:send'))); ?>
</div>
