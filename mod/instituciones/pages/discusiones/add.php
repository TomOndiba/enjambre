<?php

/*
  page para agregar discusiones en una red
 * carga la vista de save discussion y envia al action save ubicadas en el plugin Groups
 */
elgg_load_css('logged');
$id = get_input('id');
$grupo = new ElggInstitucion($id);

$title = $institucion->name;
$user = elgg_get_logged_in_user_entity();

$group = get_entity($id);
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
$body_vars['container_guid'] = $grupo->guid;


$content.= elgg_view_form('discussion/save', array(), $body_vars);

$body = array('izquierda' => elgg_view('instituciones/profile/menu', array('institucion' => $grupo)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('institucion' => $grupo));
