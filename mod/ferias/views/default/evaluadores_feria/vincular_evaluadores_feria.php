<?php
$guid_feria = $vars['guid_feria'];
$feria = new ElggFeria($guid_feria);

echo elgg_view("input/hidden", array("id" => 'guid_feria', 'value' => $guid_feria));
?>
<div class = "content-coordinacion">
    <div class = "titulo-coordinacion">
        <h2>Feria: <?php echo $feria->name; ?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("ferias/menu", array('guid' => $feria->guid)); ?>
    </div>

    <div class="contenido-coordinacion">
        <h2>Evaluadores de Feria</h2><br>
        <ul class="tabs-coordinacion">
            <li class="selected" id="asignados"><a href="#" class="tab-evaluadores" name="asignados" rel="nofollow">Aceptados</a></li>
            <li id="no-asignados"><a href="#" class="tab-evaluadores" name="no-asignados" title="" rel="nofollow">No aceptados</a></li>
        </ul>
        <div class="tabs-evaluadores">
            <div class="no-asignados">
                <?php echo elgg_view("evaluadores_feria/evaluadores_no_aceptados", $vars) ?>
            </div>
            <div class="asignados">
                <?php echo elgg_view("evaluadores_feria/evaluadores_aceptados", $vars) ?>
            </div>
        </div>
    </div>
</div>