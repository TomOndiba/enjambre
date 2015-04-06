<?php
$guid=  get_input('id');
elgg_load_css("coordinacion");
$content= elgg_view("reporte/reporte");
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

