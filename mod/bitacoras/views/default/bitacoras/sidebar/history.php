<?php
/**
 * History of this page
 *
 * @uses $vars['bitacora']
 */

$title = elgg_echo('pages:history');

if ($vars['bitacora']) {
	$options = array(
		'guid' => $vars['bitacora']->guid,
		'annotation_name' => 'bitacora',
		'limit' => 20,
		'reverse_order_by' => true
	);
	elgg_push_context('widgets');
	$content = elgg_list_annotations($options);
}

echo elgg_view_module('aside', $title, $content);