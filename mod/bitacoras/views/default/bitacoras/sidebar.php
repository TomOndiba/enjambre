<?php
/**
 * Pages sidebar
 */

echo elgg_view('bitacora/elements/comments_block', array(
	'subtypes' => array('bitacora', 'bitacora_top'),
	'owner_guid' => elgg_get_page_owner_guid(),
));

echo elgg_view('bitacora/elements/tagcloud_block', array(
	'subtypes' => array('bitacora', 'bitacora_top'),
	'owner_guid' => elgg_get_page_owner_guid(),
));