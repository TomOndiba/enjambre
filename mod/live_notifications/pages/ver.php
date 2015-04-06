<?php
elgg_load_js("ver_mas");
elgg_load_css("logged");
$guid= get_input('annotation');
$var=array('annotation'=>$guid);
$content= elgg_view("messageboard_notifications/ver_post", $var);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

