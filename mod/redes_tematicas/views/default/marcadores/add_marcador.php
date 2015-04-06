<?php

elgg_load_library('elgg:file');


$guid=  get_input('owner');
gatekeeper();
group_gatekeeper();

// create form

$bookmark_guid = get_input('guid_marcador');
$bookmark = get_entity($bookmark_guid);

// create form
$vars = marcadores_prepare_form_vars($bookmark);
$vars['container_guid']=$guid;
$content.= elgg_view_form('bookmarks/save', array(), $vars);
echo $content;