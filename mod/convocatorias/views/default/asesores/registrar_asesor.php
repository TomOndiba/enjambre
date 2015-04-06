<?php
$convocatoria = new ElggConvocatoria($vars['convocatoria']);
$form_registra_asesor= elgg_view_form('usuario/register_asesor', null, $vars)
?>
<div class = "content-coordinacion">
    <div class = "titulo-coordinacion">
        <h2>Convocatoria: <?php echo $convocatoria->name;
?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu", array('guid' => $convocatoria->guid)); ?>
    </div>
    <div class="contenido-coordinacion">
        <h2 class="title-legend">Registrar Asesor en Convocatoria </h2>
        
        <div>
            <?php echo $form_registra_asesor;?>
        </div>
    </div>