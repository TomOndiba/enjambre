<?php
gatekeeper();

$webinar_guid = get_input('webinar_guid');

if ( ($webinar = get_entity($webinar_guid)) && $webinar instanceof ElggWebinar){
	
			$webinar->status = 'running';
		$webinar->save();
		
		add_to_river('river/object/webinar/start','start',elgg_get_logged_in_user_guid(),$webinar->guid);
		
	
	
}else{
	register_error(elgg_echo("webinar:start:failed"));
}
$url=elgg_get_site_url()."action/webinar/join?webinar_guid={$webinar_guid}";
$url2= elgg_add_action_tokens_to_url($url);
forward($url2);
exit;
