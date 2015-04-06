<?php

function add_comentario_entity($poster, $owner, $message, $access_id = ACCESS_PUBLIC) {
	$result = $owner->annotate('comentario', $message, $access_id, $poster->guid);
	return $result;
}
function add_like_entity($poster, $owner, $message, $access_id = ACCESS_PUBLIC) {
	$result = $owner->annotate('like', $message, $access_id, $poster->guid);
	return $result;
}
function add_like_annotation($poster, $owner, $message, $access_id = ACCESS_PUBLIC) {
        $anotacion= new ElggAnnotation($owner);
        $result= $anotacion->annotate('like_comentario', $message, $access_id, $poster->guid);
	return $result;
}
function elgg_user_comento($likes){
    $user= elgg_get_logged_in_user_entity()->guid;
    foreach($likes as $like){
        if($user==$like->owner_guid){
            return $like->id;
        }
    }
    return false;
}