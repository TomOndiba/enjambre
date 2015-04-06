<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
gatekeeper();
$title = 'visitas | error';
$content = 'You shall no pass!!!!!!!!';
$vars = array(
    'content' => $content
);
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);

