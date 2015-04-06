<?php


$guid=get_input('guid');
$params=array('guid'=>$guid);
$content= elgg_view_form('cuaderno_campo/crear', NULL, $params);
echo $content;

