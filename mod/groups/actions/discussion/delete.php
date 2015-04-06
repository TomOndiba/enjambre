<?php
/**
 * Delete topic action
 *
 */



$topic_guid = (int) get_input('guid');

$topic = get_entity($topic_guid);
if (!$topic || !$topic->getSubtype() == "groupforumtopic") {
	register_error(elgg_echo('discussion:error:notdeleted'));
	forward(REFERER);
}

if (!$topic->canEdit()) {
	register_error(elgg_echo('discussion:error:permissions'));
	forward(REFERER);
}

$container = $topic->getContainerEntity();

$result = $topic->delete();
if ($result) {
	system_message(elgg_echo('discussion:topic:deleted'));
} else {
	register_error(elgg_echo('discussion:error:notdeleted'));
}

// Si el Container de la Discusion es una Red Tematica se redirecciona a  la lista de Discusiones de la Red
if($container->getSubtype()=="red_tematica"){
    forward("redes_tematicas/discusiones/$container->guid");
}
else if($container->getSubtype()=="grupo_investigacion"){
    forward("grupo_investigacion/discusiones/$container->guid");
}
else if($container->getSubtype()=="institucion"){
    forward("instituciones/discusiones/$container->guid");
}
else{
    forward("feria/discusiones/$container->guid");
}