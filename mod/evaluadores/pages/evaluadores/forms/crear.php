<?php

$title = 'crear red | registro';
$content = elgg_view_title('red de evaluadores');
$content .= elgg_view_form('evaluadores/crear');
$vars = array(
    'content' => $content
);

$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);
