<?php


$title = "Administracion de Roles";
$user = elgg_get_logged_in_user_entity();
admin_gatekeeper();
set_context('admin');
$titulo=elgg_echo("titulo:roles:listar");
$content = elgg_view_title($titulo);
$params = array("roles"=>elgg_get_list_roles());
$content .= elgg_view('roles/list',$params);
$vars = array('content' => $content);
$body = elgg_view_layout('admin', $vars);
echo elgg_view_page($title, $body);



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

