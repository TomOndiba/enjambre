<?php
elgg_load_js("reveal2");
$guid = $vars['guid_convocatoria'];
$convocatoria = new ElggConvocatoria($guid);
$options = array('relationship_guid' => $guid,
    'relationship' => 'seleccionada_a_convocatoria_especial',
    'inverse_relationship' => true);
$investigaciones = elgg_get_entities_from_relationship($options);
$size_investigaciones = count($investigaciones);
$form_seleccion_asesores = elgg_view_form('asesores/asignar_a_investigacion', null, $vars);
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
        <h2 class="title-legend">Investigaciones</h2>
        <br>
        <p>A continuación, se listan las iniciativas inscritas esta convocatoria</p><br>

        <table class="tabla-coordinador">
            <tr>
                <th>Investigacion</th>
                <th>Asesor</th>
                <th>Opciones</th>
            </tr>
            <?php
            foreach ($investigaciones as $investigacion) {
                echo elgg_view("investigaciones/especiales/investigacion", array('investigacion' => $investigacion,
                    'convocatoria' => $guid));
            }
            if ($size_investigaciones == 0) {
                echo "<tr><td colspan='3' style='text-align:center'>No hay investigaciones registradas</td></tr>";
            }
            ?>
        </table>
    </div>
    <div id="myModal" class="reveal-modal" style="top:90px">
        <div class="close-reveal-modal"></div>
        <div class="form-asesor-evaluador" id="pop-up-form">
            <div class='titulo-pop-up' style="font-size: 20px; text-align: center">
                Asignar Asesor
            </div>
            <div class="content-pop-up" id='content-pop-up' style="padding-top: 10px;">
                <?php echo $form_seleccion_asesores; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function seleccionarAsesor(asesor, investigacion){
        $('#investigacion').val(investigacion);
    }
</script>



