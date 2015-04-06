<?php

$user = $vars['entity'];
$evaluador = new ElggUsuario($user->guid);
$url = elgg_get_site_url() . "action/evaluadores/aceptar_evaluador_banco?guid_eval=" . $evaluador->guid;
$url_add = elgg_add_action_tokens_to_url($url);
$url2 = elgg_get_site_url() . "action/evaluadores/rechazar_evaluador_banco?guid_eval=" . $evaluador->guid;
$url_rechazar = elgg_add_action_tokens_to_url($url2);
$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$user->username."'><img src='{$evaluador->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$evaluador->name} {$evaluador->apellidos}</span></a></div>"
        . "<ul><li><a href = '".elgg_get_site_url()."evaluadores/ver_hojadevida/$evaluador->guid'>Hoja de Vida</a></li>"
        . "<li><a href='$url_add'>Aceptar</a></li> "
        . "<li><a href='$url_rechazar'>Rechazar</a></li></ul></div>"// aqui deberia ir un enlace a la hoja de vida
        . "</li>";
echo $contenido;
