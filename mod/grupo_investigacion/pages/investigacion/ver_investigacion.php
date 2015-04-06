<?php

/**
 * List a user's or group's pages
 *
 * @package ElggPages
 */

elgg_load_css('logged');

$guid = get_input('id_grupo');
$guid_inv = get_input('id_investigacion');

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

$vector['entities']=$entities;
$vector['investigacion']= $investigacion;
$vector['id_grupo']= $grupo->guid;
$content= elgg_view('investigacion/ver', $vector);

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 
