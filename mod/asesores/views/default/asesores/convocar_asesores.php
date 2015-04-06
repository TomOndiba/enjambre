<?php

$guid= $vars['id'];
$convocatoria= new ElggConvocatoria($guid);
?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
<h2>Convocatoria: <?php echo $convocatoria->name;
?></h2>
</div>
<div class="menu-coordinacion">
<?php echo elgg_view("convocatorias/menu", array('guid' => $guid)); ?>
</div>
<div class="contenido-coordinacion">
    <?php echo elgg_view_form("asesores/convocar_asesores", NULL, $vars); ?>
</div>
