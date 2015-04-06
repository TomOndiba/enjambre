<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$txt ="";
$txt.="<div class=\"message-board-grupo-investigacion box\">";
$options = array(
	'type' => 'object',
	'subtype' => 'blog',
	'container_guid' => $vars['guid'],
	'limit' => $num,
	'full_view' => FALSE,
	'pagination' => FALSE,
);
$content = elgg_list_entities($options);
$txt.=$content;
$txt.="</div>";
echo $txt;

//echo elgg_view_module('aside', 'Blogs', $content);

