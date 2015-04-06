<?php

$guid= $vars['id'];
$nombre=$vars['nombre'];
?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
<h2>Feria: <?php echo $nombre;
?></h2>
</div>
<div class="menu-coordinacion">
<?php echo elgg_view("ferias/menu", array('guid' => $guid)); ?>
</div>
<div class="contenido-coordinacion">
    <?php echo elgg_view_form("ferias/vincular_patrocinador_feria", NULL, $vars); ?>
</div>
