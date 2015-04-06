<?php

$user = $vars['entity'];
$asesor = new ElggUsuario($user->guid);
$lineas= elgg_get_lineas_asesor($asesor->guid);
$url= elgg_get_site_url()."action/asesores/aceptar_asesor?guid=".$asesor->guid;
$url_inscribirme_asesor=  elgg_add_action_tokens_to_url($url);

$url2=  elgg_get_site_url()."action/asesores/rechazar_asesor_banco?guid=".$asesor->guid;
$url_rechazar=elgg_add_action_tokens_to_url($url2);

$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$user->username."'><img src='{$asesor->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$asesor->name} {$evaluador->apellidos}</span></a></div>"
        . "<ul><li><a href = '".elgg_get_site_url()."asesores/ver_hojadevida/$user->guid'>Hoja de Vida</a></li>"// aqui deberia ir un enlace a la hoja de vida
        . "<li><a href='$url_inscribirme_asesor'>Aceptar</a></li> "
        . "<li><a href='$url_rechazar'>Rechazar</a></li></ul></div>"// aqui deberia ir un enlace a la hoja de vida
        . "</li>";
echo $contenido;

