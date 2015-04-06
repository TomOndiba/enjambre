<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nombre= get_input('nombre_usuario');
$usuarios= elgg_get_usuarios_by_nombre($nombre);
$data="";
$lista = "<ul class='elgg-list'>";
foreach ($usuarios as $miembro) {
    $lista .= "<li id='elgg-elgg-object' class='elgg-item'>"
            . "<div class='elgg-image-block clearfix'>"
            . "<div class='elgg-image'><img src='" . $miembro['icono'] . "' alt='" . $miembro['nombre'] . "' width='40' height='40'>"
            . "</div>"
            . "<div class='elgg-body'><h3>" . $miembro['nombre'] . "</h3><div class='elgg-subtext'>"
            . $miembro['rol'] . "&nbsp;&nbsp;&nbsp;&nbsp;<a class='".$miembro['guid']."' id='enlaceajax'>Administrar</a></div>"
            . "</div>"
            . "</div>"
            . "<div id='select-rol-" . $miembro['guid'] . "' class='" . $miembro['rol'] . "'>"
            . "</div>"
            . "</li>";
}
$lista.="</ul>";
echo $lista;