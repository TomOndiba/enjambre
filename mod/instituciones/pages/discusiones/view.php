<?php

/**
 * View a file
 *
 * @package ElggFile
 */
elgg_load_css('logged');


$id = get_input('id');
$grupo = new ElggInstitucion($id);

$title = $grupo->name;

$params['guid'] = $grupo->guid;

//$content = elgg_view('redes_tematicas/profile/header', $params);

global $autofeed;
$autofeed = true;

$guid = get_input('guid_dis');
$topic = get_entity($guid);
if (!$topic) {
    register_error(elgg_echo('noaccess'));
    $_SESSION['last_forward_from'] = current_page_url();
    forward('');
}

$group = $topic->getContainerEntity();
if (!$group) {
    register_error(elgg_echo('group:notfound'));
    forward();
}

elgg_set_page_owner_guid($group->getGUID());

group_gatekeeper();

$content.= elgg_view('discusiones/ver_discusion', array('full_view' => true, 'entity' => $topic));


$body = array('izquierda' => elgg_view('instituciones/profile/menu', array('institucion' => $grupo)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('institucion' => $grupo));
