<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$limit = 14;
$all_link = elgg_view('output/url', array(
	'href' => 'grupo_investigacion/members/' . $vars['guid'],
	'text' => elgg_echo('groups:members:vermas'),
	'is_trusted' => true,
));

$body= elgg_list_entities_from_relationship(array(
        'relationship' => 'es_miembro_de',
	'relationship_guid' => $vars['guid'],
	'inverse_relationship' => true,
	'type' => 'user',
        'size'=>'small',
	'limit' => $limit,
	'list_type' => 'gallery',
	'gallery_class' => 'imagen-mediana elgg-gallery-users ',
	'pagination' => false
));
if($body==""){
    $body.="El grupo aún no tiene membros";
}else {
    $body .= "</div><div class='right link-todos'>$all_link";
}
echo $body;