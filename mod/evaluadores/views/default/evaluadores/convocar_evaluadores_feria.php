<?php

$guid= $vars['guid_feria'];
$nombre_feria= $vars['nombre_feria'];
?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
<h2>Convocatoria: <?php echo $nombre_feria;
?></h2>
</div>
<div class="menu-coordinacion">
<?php echo elgg_view("ferias/menu", array('guid' => $guid)); ?>
</div>
<div class="contenido-coordinacion">
    <?php echo elgg_view_form("evaluadores/convocar_evaluadores_feria", NULL, $vars); ?>
</div>
