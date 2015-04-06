<?php


$entity = $vars['entity'];
$guid_feria= $vars['guid'];
$evaluador = new ElggUsuario($entity->guid);


$vars = array('guid' => $entity->guid, 'guid_feria'=>$guid_feria);
$title_link = elgg_extract('title', $vars, '');

$url="";

$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'><img src='{$evaluador->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$evaluador->name} {$evaluador->apellidos}</span></a></div>"
        . "<ul><li><a href = '".elgg_get_site_url()."evaluadores/ver_hojadevida/$evaluador->guid'>Hoja de Vida</a></li>"
        . "</ul></div>"
        . "</li>";
echo $contenido;

