<?php
/**
 * Elgg messageboard widget view
 *
 */

$owner=$vars['owner'];
if (elgg_is_logged_in()) {
	echo elgg_view_form('messageboard/add', array('name' => 'elgg-messageboard'),array('guid'=>$owner->guid));
}

$options = array(
	'annotations_name' => 'messageboard',
	'guid' => $owner->guid,
	'limit' => 2,
	'pagination' => true,
	'reverse_order_by' => true,
);

echo elgg_list_annotations($options);

if ($owner instanceof ElggGroup) {
	$url = "messageboard/group/$owner->guid/all";
} else {
	$url = "messageboard/owner/$owner->username";
}

echo elgg_view('output/url', array(
	'href' => $url,
	'text' => elgg_echo('messageboard:viewall'),
	'is_trusted' => true,
));