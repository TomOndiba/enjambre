<?php
/**
 * Vista que muestra en un combo los evaluadores de una feria
 * @author Erika
 */
$guid_feria = get_input('feria');
$entity=get_entity($guid_feria);
$evaluadores = elgg_get_relationship_inversa($entity, "es_evaluador_feria");


if (sizeof($evaluadores) > 0) {
    $options = array('' => 'Seleccione un Evaluador');
    foreach ($evaluadores as $ev) {
        $options[$ev->guid] = $ev->name;
    }
}else{
    $options = array('' => 'No hay Evaluadores en la Feria');
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
        elgg.get('ajax/view/reporte/evaluador/proyectos_evaluados_feria/reporte_proyectos_evaluador_feria', {
            timeout: 30000,
            data: {
                guid_evaluador: evaluador,
                guid_feria: <?php echo $guid_feria;?>
            },
            success: function(result, success, xhr) {
                $("#result").html(result);
            },
        });

    }
</script>