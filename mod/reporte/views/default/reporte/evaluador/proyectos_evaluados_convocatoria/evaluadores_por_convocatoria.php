<?php
/**
 * Vista que muestra en un combo los asesores de una convocatoria
 * @author Erika Parra
 */
$conv = get_input('guid_conv');
$entity=get_entity($conv);
$evaluadores = elgg_get_relationship_inversa($entity, "es_evaluador_convocatoria");


if (sizeof($evaluadores) > 0) {
    $options = array('' => 'Seleccione un Evaluador');
    foreach ($evaluadores as $ev) {
        $options[$ev->guid] = $ev->name;
    }
}else{
    $options = array('' => 'No hay Evaluadores en la Convocatoria');
}

$select = elgg_view('input/dropdown', array(
    'name' => 'evaluador',
    'class' => 'select',
    'options_values' => $options,
    'onchange' => 'verReporteProyEvaluador(this)',
    'class' => 'select-reportes'
        ));

echo $select;
?>
<script>
    function verReporteProyEvaluador(element) {
        var evaluador = $(element).val();
        elgg.get('ajax/view/reporte/evaluador/proyectos_evaluados_convocatoria/reporte_proyectos_evaluador_conv', {
            timeout: 30000,
            data: {
                guid_evaluador: evaluador,
                guid_conv: <?php echo $conv;?>
            },
            success: function(result, success, xhr) {
                $("#result").html(result);
            },
        });

    }
</script>