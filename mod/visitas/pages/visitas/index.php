<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
gatekeeper();
elgg_load_css("coordinacion");
elgg_load_css('bitacoras');
$title = 'visitas | indice';

$content = elgg_view('visitas/list');
$mensaje = elgg_echo('visitas:registrar:visita');
$sitio = elgg_get_site_url().'visitas/registrar';
$content .= "<hr/><div> <a href='$sitio'> $mensaje</a> </div>";

$vars = array(
    'content' => $content
);
//$body = elgg_view_layout('two_column_left_sidebar', $vars);
//$body = elgg_view_layout('one_column', $vars);
//echo elgg_view_page($title, $body);
echo elgg_view_page($title, $vars, "coordinacion_one_column", array());
