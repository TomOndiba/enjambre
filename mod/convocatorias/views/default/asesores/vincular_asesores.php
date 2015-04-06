<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
elgg_load_js("vincular-asesores");
elgg_load_js('vista_modal1');
elgg_load_js('sumar');
$guid_convocatoria = $vars['guid_convocatoria'];
$convocatoria = new ElggConvocatoria($guid_convocatoria);
$site_url = elgg_get_site_url();
$url = "{$site_url}action/asesores/notificar_asesores?id_conv={$convocatoria->guid}";
$url_action = elgg_add_action_tokens_to_url($url);
$link = "<div class='contenedor-button'><a href='{$url_action}' class='link-button'>Finalizar y Notificar</a></div>";
echo elgg_view("input/hidden", array("id" => 'convocatoria', 'value' => $guid_convocatoria));
?>


<div class = "content-coordinacion">
    <div class = "titulo-coordinacion">
        <h2>Convocatoria: <?php echo $convocatoria->name;
?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu", array('guid' => $guid_convocatoria)); ?>
    </div>


    <div class="contenido-coordinacion">
        <h2>Asesores de Convocatoria</h2><br>

        <div style='display:none;' id='evaluar_asesor' title='Evaluar Asesor'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span></p></div>
        <ul class="tabs-coordinacion">
            <li class="selected" id="asignados"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Aceptados</a></li>
            <li id="no-asignados"><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">No aceptados</a></li>
        </ul>
        <div class="tabs-asesores">
            <div class="no-asignados">
                <?php echo elgg_view("asesores/vincular/no_asignados", $vars) ?>
            </div>
            <div class="asignados">
                <?php echo elgg_view("asesores/vincular/asignados", $vars) ?>
            </div>



        </div>
          <?php echo $link; ?>

    </div>
</div>