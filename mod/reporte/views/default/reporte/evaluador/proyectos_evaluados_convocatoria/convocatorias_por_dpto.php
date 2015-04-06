<?php

/**
 * Vista que pinta el select con el listado de convocatorias por el dpto
 * @author Erika Parra
 */

$dpto = get_input('dpto');
$convo = elgg_get_convocatias_BY_departamento($dpto);
echo $convo;
?>
<script>
function verReporteConvBYDpto(element){
        var conv = $(element).val();
        elgg.get('ajax/view/reporte/evaluador/proyectos_evaluados_convocatoria/evaluadores_por_convocatoria', {
            timeout: 30000,
            data: {
                guid_conv: conv
            },
            success: function(result, success, xhr) {
                $("#evaluador-conv").html(result);
            },
        });

    }
</script>