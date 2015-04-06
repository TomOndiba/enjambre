<?php


$entity = $vars['entity'];
$usuario = new ElggUsuario($entity->guid);



$vars = array('guid' => $entity->guid);
$title_link = elgg_extract('title', $vars, '');
$subtype=$usuario->getSubtype();
$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'><img src='{$usuario->getIconURL()}' /></a><div><a><span class='name-usuario'>{$usuario->name} {$usuario->apellidos}</span></a>"
        . "<br><br>".  ucfirst($subtype)
        . "</div></li>";
echo $contenido;

