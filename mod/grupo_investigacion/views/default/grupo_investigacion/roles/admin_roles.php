<?php

elgg_load_js('admin-grupo/roles');
$miembros = $vars['miembros'];
$ajax = $vars['ajax'];
$hidden = elgg_view('input/hidden', array(
    'value' => $vars['grupo']['guid'],
    'id' => 'idGrupo',
        ));
$lista = "<ul class='elgg-list'>";
foreach ($miembros as $miembro) {
    $lista .= "<li id='elgg-elgg-object' class='elgg-item'>"
            . "<div class='elgg-image-block clearfix'>"
            . "<div class='elgg-image'><img src='" . $miembro['icono'] . "' alt='" . $miembro['nombre'] . "' width='40' height='40'>"
            . "</div>"
            . "<div class='elgg-body'><h3>" . $miembro['nombre'] . "</h3><div class='elgg-subtext'>"
            . $miembro['rol'] . "&nbsp;&nbsp;&nbsp;&nbsp;<a class='link' id='" . $miembro['guid'] . "'>Cambiar Rol</a></div>"
            . "</div>"
            . "</div>"
            . "<div id='select-rol-" . $miembro['guid'] . "' class='" . $miembro['rol'] . "'>"
            . "</div>"
            . "</li>";
}
$lista.="</ul>";
$titulo = elgg_echo('grupo_investigacion:titulo:lista');
if ($ajax == 0) {
    echo <<<HTML

<h3>$titulo</h3>
<div id="tabla">$lista            
$hidden
</div>    
HTML;
} 
else {
    echo <<<HTML
    $lista
$hidden
HTML;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

