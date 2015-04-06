<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
gatekeeper();
$title = 'visitas | error';
$content = 'Esta intentando acceder a un lugar que no existe, ¿Esta borracho?';
$vars = array(
    'content' => $content
);
$body = elgg_view_layout('two_column_left_sidebar', $vars);
echo elgg_view_page($title, $body);

