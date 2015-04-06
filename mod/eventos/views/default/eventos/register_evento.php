<?php

$guid= $vars['id'];
$nombre=$vars['nombre'];
$entity=  get_entity($guid);

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
<?php echo elgg_view("convocatorias/menu", array('guid' => $guid)); ?>
</div>
<div class="contenido-coordinacion">
    <?php echo elgg_view_form("eventos/form_register_evento", NULL, $vars); ?>
</div>
