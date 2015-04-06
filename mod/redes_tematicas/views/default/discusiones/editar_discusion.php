<?php

/*
  page para editar discusiones 
 * carga la vista de save discussion y envia al action save ubicadas en el plugin Groups
 */

$id = get_input('id');
$grupo = new ElggInstitucion($id);

$title = $grupo->name;



$foro=get_input('guid_dis');
$topic = get_entity($foro);
		if (!$topic || !$topic->canEdit()) {
			register_error(elgg_echo('discussion:topic:notfound'));
			forward();
		}
		$group = $topic->getContainerEntity();
		if (!$group) {
			register_error(elgg_echo('group:notfound'));
			forward();
		}

		$title = elgg_echo('groups:edittopic');

		

$body_vars = discussiones_prepare_form_vars($topic);
$body_vars['container_guid'] = $grupo->guid;


$content.= elgg_view_form('discussion/save', array(), $body_vars);

echo $content;
