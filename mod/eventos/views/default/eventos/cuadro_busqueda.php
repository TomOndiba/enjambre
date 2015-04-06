<?php

elgg_load_js('busqueda');

$id_conv=$vars['id_conv'];
$id_evento=$vars['id'];
$nombre_convocatoria=$vars['nombre_conv'];
$nombre_evento=$vars['nombre'];

$url_re=elgg_get_site_url();
$url_asistencia= $url_re."eventos/registro_asistencia/$id_evento/$id_conv";

$entity=  get_entity($id_conv);
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
<h2> Agregar Asistentes al evento $nombre_evento</h2>
<div>
   $instruct</div>
 
<div>
    <input type="text" class="buscar" id="cajabusqueda" placeholder="Escriba el nombre del usuario.."/>
    <input type="hidden" id="id_conv" value='$id_conv'/>
    <input type="hidden" id="id_evento" value='$id_evento'/>
   
</div>
<div class='contenedor-button'>
     
    <a class='link-button' href='$url_asistencia'>Regresar</a>
    
</div>   
HTML;
?>
