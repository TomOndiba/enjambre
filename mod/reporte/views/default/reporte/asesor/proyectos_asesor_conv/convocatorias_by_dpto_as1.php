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
        elgg.get('ajax/view/reporte/asesor/proyectos_asesor_conv/asesores_by_convocatoria', {
            timeout: 30000,
            data: {
                guid_conv: conv
            },
            success: function(result, success, xhr) {
                $("#asesor").html(result);
            },
        });

    }
</script>