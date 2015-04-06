<?php


$entity = $vars['entity'];
$usuario = new ElggUsuario($entity->guid);

$vars = array('guid' => $entity->guid);
$title_link = elgg_extract('title', $vars, '');
$subtype=$usuario->getSubtype();
if($subtype=='estudiante'){
    $institucion=  elgg_get_relationship($usuario, "estudia_en")[0];
}else if ($subtype=='maestro'){
    $institucion=  elgg_get_relationship($usuario, "trabaja_en")[0];
}

$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'><img src='{$usuario->getIconURL()}' /></a><div><a><span class='name-usuario'>{$usuario->name} {$usuario->apellidos}</span></a>"
        . "<br><br>".  $entity->username
        . "<br><br>".  ucfirst($subtype)
        . "<br><br>".  $institucion->name
        . "</div>"
        . "</li>";
echo $contenido;

