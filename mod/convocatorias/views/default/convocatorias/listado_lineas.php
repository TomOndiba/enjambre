<?php

$guid= $vars['id'];

?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
<h2>Convocatoria: <?php echo $vars['nombre'];
?></h2>
</div>
<div class="menu-coordinacion">
<?php echo elgg_view("convocatorias/menu", array('guid' => $guid)); ?>
</div>
<div class="contenido-coordinacion">
    <?php echo elgg_view_form("convocatorias/listado_lineas", NULL, $vars); ?>
</div>
