<?php
$guid=  get_input('guid');
$group = get_entity($guid);
if (!$group) {
    register_error(elgg_echo('group:notfound'));
    forward();
}

// make sure user has permissions to add a topic to container
if (!$group->canWriteToContainer(0, 'object', 'groupforumtopic')) {
    register_error(elgg_echo('groups:permissions:error'));
    forward($group->getURL());
}

//		$title = elgg_echo('groups:addtopic');
//
//		elgg_push_breadcrumb($group->name, "discussion/owner/$group->guid");
//		elgg_push_breadcrumb($title);

$body_vars = discussiones_prepare_form_vars();
$body_vars['container_guid'] = $guid;


//$content = elgg_view('redes_tematicas/profile/header', $params);
$content.= elgg_view_form('discussion/save', array(), $body_vars);
echo $content;