<?php
$guid = $vars["guid_convocatoria"];
$investigaciones = $vars["investigaciones"];



$tabla1 = "<br><table class='tabla-coordinador' width='40%' align='center'> 
        <tr><th>Investigación</th>
            <th>Convocatoria anterior</th>
            <th>Fecha cierre convocatoria</th>
            <th>Línea temática con la que se inscribió</th>
            <th>Seleccionar</th></tr>";



foreach ($investigaciones as $inv) {
  
    $label = $inv['nombre'] . "/" . $inv['convocatoria'] . "/" . $inv['fecha_cierre']."/" . $inv['linea'];
    $options[$label] = $inv['id_inv']. "/" . $inv['id_conv']. "/" . $inv['id_linea'];
}

$tabla1.=elgg_view('input/checkboxes_3', array('name' => 'elegidas', 'align' => 'Vertical', 'options' => $options));
$button = elgg_view('input/submit', array('value' => elgg_echo('Invitar')));
$id_c = elgg_view('input/hidden', array('name' => 'id_conv', 'value' => $guid));
$tabla1.="</table>";

if (!empty($investigaciones)) {
    $instruct = elgg_echo('convocatorias:elegibles:instruct');
} else {
    $instruct = elgg_echo('convocatorias:no:elegibles:instruct');
    $tabla1 = "";
    $button = "";
}
?>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Convocatoria: <?php echo $nombre; ?></h2>
    </div>
    <div class="menu-coordinacion">
<?php echo elgg_view("convocatorias/menu", array('guid' => $guid)); ?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Banco de Investigaciones Elegibles
        </h2>
<?php
echo <<<HTML

<div>
   $instruct <br>
   $tabla1
   $id_c
    <div class="contenedor-button" align="center">
    $button
    </div>
</div>

HTML;
?>

    </div>
</div>   
