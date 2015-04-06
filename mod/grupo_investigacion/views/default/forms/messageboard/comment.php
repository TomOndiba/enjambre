<?php

$user = elgg_get_logged_in_user_guid();


echo elgg_view('input/plaintext', array(
	'name' => 'message_content',
	'class' => 'txt-comment',
        'placeholder'=>'Escribe un comentario...',
        'tittle'=>$vars['guid'],
));

echo elgg_view('input/hidden', array(
	'name' => 'owner_guid',
	'value' => $vars['guid'],
));
