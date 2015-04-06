<?php

elgg_load_js('paginat/evaluadores');

$guid_convocatoria = $vars['guid_convocatoria'];
$convocatoria = new ElggConvocatoria($guid_convocatoria);

    ?>

<div class = "content-coordinacion">
    <div class = "titulo-coordinacion">
        <h2>Convocatoria: <?php echo $convocatoria->name; ?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu", array('guid' => $convocatoria->guid)); ?>
    </div>

    <div class="contenido-coordinacion">
        <h2>Evaluadores de Convocatoria</h2><br>
        <ul class="tabs-coordinacion">
            <li class="selected" id="asignados"><a href="#" class="tab-evaluadores" name="asignados" rel="nofollow">Aceptados</a></li>
            <li id="no-asignados"><a href="#" class="tab-evaluadores" name="no-asignados" title="" rel="nofollow">No aceptados</a></li>
        </ul>
        <div class="tabs-evaluadores">
            <div class="no-asignados">
                <?php echo elgg_view("evaluadores_conv/evaluadores_no_aceptados", $vars) ?>
            </div>
            <div class="asignados">
                <?php echo elgg_view("evaluadores_conv/evaluadores_aceptados", $vars) ?>
            </div>
        </div>
    </div>
</div>