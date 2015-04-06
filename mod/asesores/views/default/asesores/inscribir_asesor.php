<?php

$guid_user=get_input('owner');
$params=array('guid'=>$guid_user);
$content = elgg_view_form('asesores/inscripcion', null, $params);
echo $content;

