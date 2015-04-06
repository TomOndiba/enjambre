<?php
$user= $vars['entity'];
$asesor= new ElggUsuario($user->guid);
$url = elgg_get_site_url();
$contenido="<li class='item-usuario'>"
        . "<a href='".$url."profile/".$user->username."'><img src='{$asesor->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$asesor->name} {$asesor->apellidos}</span></a></div>"
        . "<ul><li><a href = '{$url}asesores/ver_hojadevida/$user->guid'>Hoja de Vida</a></li></ul></div>"// aqui deberia ir un enlace a la hoja de vida
        . "</li>";
echo $contenido;

?>
