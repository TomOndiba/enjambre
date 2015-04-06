<?php
/**
 * View a revision of page
 *
 * @package ElggPages
 */

$id = get_input('id');
$annotation = elgg_get_annotation_from_id($id);
if (!$annotation) {
	forward();
}

$page = get_entity($annotation->entity_guid);
if (!$page) {
	
}

elgg_set_page_owner_guid($page->getContainerGUID());

group_gatekeeper();

$container = elgg_get_page_owner_entity();
if (!$container) {
}

$title = $page->title . ": " . elgg_echo('pages:revision');

//if (elgg_instanceof($container, 'group')) {
//	elgg_push_breadcrumb($container->name, "bitacoras/group/$container->guid/all");
//} else {
//	elgg_push_breadcrumb($container->name, "bitacoras/owner/$container->username");
//}
//bitacoras_prepare_parent_breadcrumbs($page);
//elgg_push_breadcrumb($page->title, $page->getURL());
//elgg_push_breadcrumb(elgg_echo('pages:revision'));

$content = elgg_view('object/bitacora_top', array(
	'entity' => $page,
	'revision' => $annotation,
	'full_view' => true,
));

$sidebar = elgg_view('bitacoras/sidebar/history', array('bitacora' => $page));

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
