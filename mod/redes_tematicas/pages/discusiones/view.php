<?php

/**
 * View a file
 *
 * @package ElggFile
 */
elgg_load_css('logged');

$id = get_input('id');
$red = new ElggRedTematica($id);

$title = $red->name;
$user = elgg_get_logged_in_user_entity();

$params['title'] = $title;
$params['red'] = array(
    'nombre' => $red->name,
    'guid' => $red->guid,
    //'imagen'=>$grupo->getIconURL(),
    'descripcion' => $red->description,
);

$params['buttons'] = array();

$admin = elgg_is_admin_red($red->guid, $user->guid);
$member = elgg_is_member_red($red->guid, $user->guid);
$request = elgg_is_request_red($red->guid, $user->guid);

if (!$admin && !$member && !$request && $user) {

    $sol = elgg_get_site_url() . "action/redes_tematicas/join?id=" . $red->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud, 'value' => 'Unirse');
    array_push($params['buttons'], $array);
} else if ($admin) {

    $sol = elgg_get_site_url() . "redes_tematicas/solicitudes/" . $red->guid;
    $array = array('href' => $sol, 'value' => 'Solicitudes');
    array_push($params['buttons'], $array);
} else if ($request) {

    $sol = elgg_get_site_url() . "action/redes_tematicas/cancelrequest?id=" . $red->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud, 'value' => 'Cancelar Solicitud');
    array_push($params['buttons'], $array);
}

if ($member) {
    $sol = elgg_get_site_url() . "action/redes_tematicas/abandonar_red?id=" . $red->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Abandonar Red');
    array_push($params['buttons'], $array);
};


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
//

$body = array('izquierda' => elgg_view('redes_tematicas/profile/menu', array('red' => $red)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('red' => $red));
