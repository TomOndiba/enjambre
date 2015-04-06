<?php


$entity = $vars['entity'];
$guid_conv= $vars['guid'];
$asesor = new ElggUsuario($entity->guid);


$vars = array('guid' => $entity->guid, 'guid_convocatoria'=>$guid_conv);
$title_link = elgg_extract('title', $vars, '');

$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'><img src='{$asesor->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$asesor->name} {$asesor->apellidos}</span></a></div>"
        . "<ul><li><a href = '".elgg_get_site_url()."asesores/ver_hojadevida/$asesor->guid'>Hoja de Vida</a></li>"
        . "<li>".elgg_view("asesores/vincular/lista/option", $vars)."</li></ul></div>"
        . "</li>";
echo $contenido;

