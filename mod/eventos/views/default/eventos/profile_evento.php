<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id_conv = $vars['id_conv'];
$guid = $vars['id'];
$nombre = $vars['nombre'];
$nombre_conv=$vars['nombre_conv'];
$tipo_evento = $vars['tipo_evento'];
$fecha_limite_confirm = $vars['fecha_lim_confirmacion'];
$fecha_inicio = $vars['fecha_inicio'];
$fecha_terminacion = $vars['fecha_terminacion'];
$lugar = $vars['lugar'];
$max_asistentes = $vars['max_asistentes'];
$objetivo = $vars['objetivo'];
$dirigido_a = $vars['dirigido_a'];
$requisitos = $vars['requisitos'];


$evento = new ElggEvento($guid);
$user_guid = elgg_get_logged_in_user_guid();
$user= elgg_get_logged_in_user_entity();

$entity= get_entity($id_conv);

$url = elgg_get_site_url();
$url3 = $url . "eventos/listar_asistentes/$guid/$id_conv";
?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
 <?php 
 if($entity->getSubtype()=="convocatoria"){
     echo "<h2>Convocatoria: $entity->name</h2>";
 }
 else if($entity->getSubtype()=="feria"){
     echo "<h2>Feria: $entity->name</h2>";
 }
 else{}
?>
</div>
<div class="menu-coordinacion">
<?php 
if($entity->getSubtype()=="convocatoria"){
echo elgg_view("convocatorias/menu", array('guid' => $id_conv)); 
}
 else if($entity->getSubtype()=="feria"){
echo elgg_view("ferias/menu", array('guid' => $id_conv)); 
}
else{}
?>
</div>
<div class="contenido-coordinacion">
<?php


echo <<<HTML
<h2> Detalles del Evento </h2>
<div>
    <table  class='vertical-table' align='center' width='60%'>
        <tr><th>Tipo evento:</th>
            <td>$tipo_evento</td></tr>
        <tr><th>Fecha de inicio:</th>
            <td>$fecha_inicio</td></tr>
        <tr><th>Fecha de terminación:</th>
            <td>$fecha_terminacion</td></tr>
       <tr><th>Fecha límite confirmación:</th>
            <td>$fecha_limite_confirm</td></tr> 
        <tr><th>Lugar:</th>
            <td>$lugar</td></tr>
        <tr><th>Número máximo de asistentes:</th>
            <td>$max_asistentes</td></tr>
       <tr><th>Objetivo:</th>
            <td>$objetivo</td></tr> 
        <tr><th>Dirigido a:</th>
            <td>$dirigido_a</td></tr>
        <tr><th>Requisitos del evento:</th>
            <td>$requisitos</td></tr>
    </table>
        
        <a class='link-button' href='$url3'>Listar Asistentes</a>
        
</div>
HTML;
?>
</div>