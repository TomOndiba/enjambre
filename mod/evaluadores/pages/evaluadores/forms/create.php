<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$title = 'Inscripcion de evaluadores | registro';
$content = elgg_view_title('inscripcion de Evaluadores');
$content .= elgg_view_form('evaluadores/create');
$vars = array(
    'content' => $content
);
//no muestra una barra lateral porque el maestro no debe tener acceso a nada mas de ese plugin
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);

