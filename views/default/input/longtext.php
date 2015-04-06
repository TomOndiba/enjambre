<?php
/**
 * Elgg long text input
 * Displays a long text input field that can use WYSIWYG editor
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value']    The current value, if any - will be html encoded
 * @uses $vars['disabled'] Is the input field disabled?
 * @uses $vars['class']    Additional CSS class
 */

if (isset($vars['class'])) {
	$vars['class'] = "textarea-form {$vars['class']}";
} else {
	$vars['class'] = "textarea-form";
}



$value = $vars['value'];
unset($vars['value']);


?>

<textarea <?php echo elgg_format_attributes($vars); ?>>
<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false); ?>
</textarea>
