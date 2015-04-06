<?php
$convocatoria = new ElggConvocatoria($vars['convocatoria']);
$options = array('relationship'=> 'asesor_convocatoria',
        'relationship_guid'=>$convocatoria->guid,
    'inverse_relationship' => true);
$asesores = elgg_get_entities_from_relationship($options);
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
        <h2 class="title-legend">Asesores</h2>
        <div>
            <table class="tabla-coordinador">
                <tr>
                    <th>Asesor</th>
                </tr>
                <?php
                foreach($asesores as $asesor){
                    echo "<tr><td style='text-align:center'>{$asesor->name} {$asesor->apellidos}</td></tr>";                                        
                }?>
            </table>
        </div>
    </div>
</div>