<?php

$evaluador= get_entity(get_input('guid_eval'));

$option = array(
    'type' => 'group',
    'subtype' => 'RedEvaluadores',
);

$red_evaluadores = elgg_get_entities($option);
$group=$red_evaluadores[0];
$grupo= get_entity($group->guid);

if (check_entity_relationship($evaluador->guid, 'membership_request', $grupo->guid)) {
	remove_entity_relationship($evaluador->guid, 'membership_request', $grupo->guid);
        system_message(elgg_echo('rechazar_evaluador:ok'), 'success');
}
 else {
    register_error(elgg_echo('rechazar_evaluador:error'));
  
}
  forward(REFERER);

