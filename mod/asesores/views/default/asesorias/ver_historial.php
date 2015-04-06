<?php
$asesoria = new ElggAsesoria(get_input('asesoria'));
$investigacion = new ElggInvestigacion($asesoria->container_guid);
$options = array('type' => 'object',
    'subtype' => 'asesoria',
    'container_guid' => $investigacion->guid);
$historial = elgg_get_entities($options);
?>
<h2><center><?php echo $investigacion->name ?></center></h2><br><br>
<?php
$count = 0;
$html = "";
foreach($historial as $item) {
    $resumen = $item->resumen;
    if(!$resumen){
        $resumen = "No se ha registrado resúmen de la asesoria.";
    }
    if ($count == 5) {
        break;
    } else {
        $html .= "<p><b>Fecha:</b> $item->fecha       <b>Hora:</b> $item->hora</p>"
                . "<p style='color:black'>$resumen</p><hr><br>";
    }
    $count ++;
}
echo $html;