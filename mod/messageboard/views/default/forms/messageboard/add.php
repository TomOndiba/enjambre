<?php
/**
 * Elgg Message board add form body
 *
 * @package ElggMessageBoard
 */

echo elgg_view('input/plaintext', array(
	'name' => 'message_content',
	'class' => 'input-publicacion-muro txt-post',
        'placeholder'=> "Escribe aqui tu publicación."
));

echo elgg_view('input/hidden', array(
	'name' => 'owner_guid',
	'value' => $vars['guid'],
        'id'=>'owner',
));
