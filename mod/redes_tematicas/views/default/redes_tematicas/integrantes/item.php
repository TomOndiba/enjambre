<?php


$entity = $vars['entity'];
$usuario = new ElggInvestigacion($entity->guid);
$vars = array('guid' => $entity->guid);
$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'></a><div><a><span class='name-usuario'>{$usuario->name}</span></a>"
        ."<br>$datos <br>"
        . "</div></li>";
echo $contenido;

