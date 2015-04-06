<?php
/**
 * Vista que despliega las investigaciones asignadas al asesor
 * @author DIEGOX_CORTEX
 */
$guid_asesor = get_input('asesor');

$investigaciones = elgg_get_all_asesorias_entities($guid_asesor, 'es_asesor_de');


if (sizeof($investigaciones) > 0) {
    $options = array('x' => 'Seleccione Una Opción','todos' => 'Todas las Investigaciones');
    foreach ($investigaciones as $inv) {
        $options[$inv->guid] = $inv->name;
    }
} else {
    $options = array('x' => "No tiene Investigaciones Asignadas");
}
$select = elgg_view('input/dropdown', array(
    'name' => 'investigaciones',
    'class' => 'select',
    'options_values' => $options,
    'onchange' => 'verReporteAsesorias(this)',
    'class' => 'select-reportes'
        ));

echo $select;
?>

<script>

    function verReporteAsesorias(element) {
        var inv = $(element).val();
        if(inv === 'x'){
            $("#result").hide();
        }else{
            $("#result").show();
        }
        elgg.get('ajax/view/reporte/asesor/asesorias_by_asesor/reporte_asesorias_asesor', {
            timeout: 30000,
            data: {
                guid_inv: inv,
                guid_asesor: <?php echo $guid_asesor;?>
            },
            success: function(result, success, xhr) {
                $("#result").html(result);
            },
        });

    }

</script>