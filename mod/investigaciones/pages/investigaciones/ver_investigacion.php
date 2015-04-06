<?php

/**
 * List a user's or group's pages
 *
 * @package ElggPages
 */
elgg_load_css('logged');

$guid_inv = get_input('id_investigacion');
$guid_origen = get_input('id_origen');
$origen = get_input('origen');
elgg_load_css("investigaciones");
$investigacion = new ElggInvestigacion($guid_inv);


$grupo = new ElggGrupoInvestigacion($guid);
$title = "Investigacion: " . $investigacion->name;
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);
$params['title'] = $title;

$params['buttons'] = array();

$entities = elgg_list_entities_from_relationship(array(
    'relationship' => 'tiene_la_bitacora',
    'relationship_guid' => $guid_inv,
    'full_view' => false,
        ));


$vector['entities'] = $entities;
$vector['investigacion'] = $investigacion;
$vector['id_origen'] = $guid_origen;
$vector['origen'] = $origen;
$vars = array('content' => $content);
$body = array('variables' => $vector, 'content' => elgg_view("investigaciones/ver", $vector));
echo elgg_view_page($title, $body, "investigacion", array());
