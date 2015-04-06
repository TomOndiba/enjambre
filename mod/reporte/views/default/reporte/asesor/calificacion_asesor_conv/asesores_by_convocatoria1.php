<?php
/**
 * Vista que muestra en un combo los asesores de una convocatoria
 * @author DIEGOX_CORTEX
 */
$conv = get_input('guid_conv');
$asesores = elgg_get_asesores_asignados_convocatoria($conv);

if (sizeof($asesores) > 0) {
    $options = array('Seleccione' => 'Seleccione un Asesor');
    foreach ($asesores as $as) {
        $options[$as->guid] = $as->name;
    }
}else{
    $options = array('Seleccione' => 'No hay Asesores en la Convocatoria');
}

$select = elgg_view('input/dropdown', array(
    'name' => 'asesores',
    'class' => 'select',
    'options_values' => $options,
    'onchange' => 'verReporteProyAsesor(this)',
    'class' => 'select-reportes'
        ));

echo $select;
?>
<script>
    function verReporteProyAsesor(element) {
        var asesor = $(element).val();
        elgg.get('ajax/view/reporte/asesor/calificacion_asesor_conv/reporte_calificacion_asesor_conv', {
            timeout: 30000,
            data: {
                guid_asesor: asesor,
                guid_conv: <?php echo $conv;?>
            },
            success: function(result, success, xhr) {
                $("#result").html(result);
            },
        });

    }
</script>