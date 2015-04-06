<?php

/*
  page para agregar discusiones en una red
 * carga la vista de save discussion y envia al action save ubicadas en el plugin Groups
 */
elgg_load_css('logged');

$id = get_input('id');
$feria = new ElggFeria($id);

$title = $feria->name;
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
$body_vars['container_guid'] = $feria->guid;


//$content = elgg_view('redes_tematicas/profile/header', $params);
$content.= elgg_view_form('discussion/save', array(), $body_vars);

$body = array('izquierda' => elgg_view('ferias_publico/profile/menu', array('feria' => $feria)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('feria' => $feria));
