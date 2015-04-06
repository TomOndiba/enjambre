<?php
$elements= $vars['bread'];
$lista='<ul class="elgg-menu elgg-breadcrumbs mts">';
foreach($elements as $element){
    $lista.="<li><a href='{$element['url']}'>{$element['titulo']}</a></li>";
}
echo $lista.="</ul>";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

