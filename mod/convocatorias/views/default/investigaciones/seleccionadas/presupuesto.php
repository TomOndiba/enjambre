<?php

$guid= $vars['guid_convocatoria'];

?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
<h2>Convocatoria: <?php echo $nombre_convocatoria;
?></h2>
</div>
<div class="menu-coordinacion">
<?php echo elgg_view("convocatorias/menu", array('guid' => $guid)); ?>
</div>
<div class="contenido-coordinacion">
    <?php echo elgg_view_form("investigaciones/seleccionadas/presupuesto_inv", NULL, $vars); ?>
</div>
