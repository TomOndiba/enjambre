<?php
$group = $vars['entity'];

$icon = elgg_view_entity_icon($group, 'small');
if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}


if ($vars['full_view']) {
	echo elgg_view('groups/profile/summary', $vars);
} else {
	// brief view
	$params = array(
		'entity' => $group,
		'metadata' => $metadata,
		'subtitle' => $group->briefdescription,
	);
	$params = $params + $vars;
	$list_body = elgg_view('grupo_investigacion/lista/sumary_investigacion', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}