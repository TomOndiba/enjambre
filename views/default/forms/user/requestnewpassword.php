<?php
/**
 * Elgg forgotten password.
 *
 * @package Elgg
 * @subpackage Core
 */
?>

 <h2 class="title-legend">Restaurar Contrase&ntilde;a</h2>

<div>
	<label><?php echo elgg_echo('loginusername'); ?></label><br />
	<?php echo elgg_view('input/text', array(
		'name' => 'username',
		'class' => 'elgg-autofocus',
		));
	?>
</div>
<?php echo elgg_view('input/captcha'); ?>
<div class="elgg-foot">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('request'))); ?>
</div>
