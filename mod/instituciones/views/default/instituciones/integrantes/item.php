<?php


$entity = $vars['entity'];
$usuario = new ElggUsuario($entity->guid);

$vars = array('guid' => $entity->guid);
$title_link = elgg_extract('title', $vars, '');
$subtype=$usuario->getSubtype();

if($subtype=="estudiante"){
    
    $fecha = $usuario->fecha_nacimiento;
    list($Y, $m, $d) = explode("-", $fecha);
    $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
    $datos="<br><label> Edad:</label>".$edad."<br>"
         . "<label> Curso:".$usuario->curso;           
}

$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'><img src='{$usuario->getIconURL()}' /></a><div><a><span class='name-usuario'>{$usuario->name} {$usuario->apellidos}</span></a>"
        ."<br>$datos <br>"
        . "<br><br>".  ucfirst($subtype)
        . "</div></li>";
echo $contenido;

