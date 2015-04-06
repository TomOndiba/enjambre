<?php

global $CONFIG;

$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_by_name('evaluador');
$opt = array(
    'type' => 'group',
    'subtype' => 'RedEvaluadores',
    'name' => 'evaluadores',
);
$rta = elgg_get_entities($opt);
//$grupo = $rta[0];

$grupo = elgg_get_grupo_evaluadores();


if(!check_entity_relationship($user->guid, 'membership_request', $grupo->guid)){
    if(check_entity_relationship($user->guid, 'member', $grupo->guid)){
 
    system_message('YA ESTA REGISTRADO');
    forward(REFERER);
    }
    add_entity_relationship($user->guid, 'membership_request', $grupo->guid);
    system_message("Te has registrado al banco de evaluadores");
    forward(REFERER);
}

