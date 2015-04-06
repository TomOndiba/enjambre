<?php
$user= $vars['entity'];
$evaluador= new ElggUsuario($user->guid);
$contenido="<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$user->username."'><img src='{$evaluador->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$evaluador->name} {$evaluador->apellidos}</span></a></div>"
        . "<ul><li><a href = '".elgg_get_site_url()."evaluadores/ver_hojadevida/$user->guid'>Hoja de Vida</a></li></ul></div>"// aqui deberia ir un enlace a la hoja de vida
        . "</li>";
echo $contenido;