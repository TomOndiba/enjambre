<?php

$guid_conv=$vars['id_conv'];
$nombre_convocatoria=$vars['nombre_conv'];

$entity=  get_entity($guid_conv);
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
    <?php echo elgg_view_form("eventos/form_register_asistencia", NULL, $vars); ?>
</div>
