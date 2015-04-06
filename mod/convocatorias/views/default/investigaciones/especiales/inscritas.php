<?php
$guid = $vars['guid_convocatoria'];
$convocatoria = new ElggConvocatoria($guid);
$options = array('relationship_guid' => $guid,
    'relationship' => 'inscrita_a_convocatoria_especial',
    'inverse_relationship' => true);
$iniciativas = elgg_get_entities_from_relationship($options);
$size_iniciativas = count($iniciativas);
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
        <h2 class="title-legend">Iniciativas Inscritas</h2>
        <br>
        <p>A continuación, se listan las iniciativas inscritas esta convocatoria</p><br>

        <table class="tabla-coordinador">
            <tr>
                <th>Iniciativa</th>
                <th>Opciones</th>
            </tr>
            <?php
            foreach ($iniciativas as $investigacion) {
                echo elgg_view("investigaciones/especiales/iniciativa", array('iniciativa' => $investigacion, 
                    'convocatoria'=>$guid));
            }
            if($size_iniciativas == 0){
                echo "<tr><td colspan='2' style='text-align:center'>No hay iniciativas registradas</td></tr>";
            }
            ?>
        </table>
    </div>



