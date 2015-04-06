<?php

/**
 * Vista que pinta el select con el listado de convocatorias por el dpto
 * @author DIEGOX_CORTEX
 */

$dpto = get_input('departamento');
$convo = elgg_get_convocatias_BY_departamento($dpto);
echo $convo;
?>
<script>
function verReporteConvBYDpto(element){
        var conv = $(element).val();
        elgg.get('ajax/view/reporte/convocatoria/ferias_en_convocatorias/reporte_ferias_in_conv', {
            timeout: 30000,
            data: {
                guid_conv: conv
            },
            success: function(result, success, xhr) {
                $("#result").html(result);
            },
        });

    }
</script>