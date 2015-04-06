<?php
elgg_load_js("investigaciones-convocatoria");
elgg_load_js("lista-investigaciones");
elgg_load_js("asesores");
elgg_load_js('vista_modal1');
elgg_load_js('buscar_lineas_tipo');
elgg_load_js('reveal2');
elgg_load_js('validarCampos');
elgg_load_js('sumar');

$id = $vars['guid_convocatoria'];
$convocatoria= new ElggConvocatoria($id);
$convocatoria_input = elgg_view('input/hidden', array('id' => 'convocatoria', 'value' => $id));
echo $convocatoria_input;
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
        <h2>
            Investigaciones:
        </h2>

        <ul class="tabs-coordinacion">
            <li id="preinscritas" class="selected"><a href="#preinscritas" class="ver-lista-investigaciones" name="preinscritas" rel="nofollow">Pre-Inscritas</a></li>
            <li id="inscritas"><a href="#inscritas" class="ver-lista-investigaciones" name="inscritas" title="" rel="nofollow">Inscritas</a></li>
            <li id="preseleccionadas"><a href="#preseleccionadas" class="ver-lista-investigaciones" name="preseleccionadas" rel="nofollow">Evaluadas</a></li>
            <li id="seleccionadas"><a href="#seleccionadas" class="ver-lista-investigaciones" name="seleccionadas" rel="nofollow">Seleccionadas</a></li>
        </ul>
        <div id="ajax-investigaciones">
        </div>
    </div>
</div>