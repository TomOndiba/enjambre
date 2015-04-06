<h2 class="titulo-reportes title-legend">Reporte Grupos de Investigación en Convocatoria</h2>
<br><label> Seleccione el departamento y la convocatoria para generar el reporte.</label>
<?php

/**
 * Vista que muestra el listado de dpto's  para consultar el listado de convocatorias
 * @author DIEGOX_CORTEX
 */
$select_departamento = elgg_view('input/dropdown', array(
    'name' => 'dpto_nacimiento',
    'class' => 'select',
    'options_values' => array('Amazonas' => elgg_echo('Amazonas'),
        'Antioquia' => elgg_echo('Antioquia'),
        'Arauca' => elgg_echo('Arauca'),
        'Atlantico' => elgg_echo('Atlantico'),
        'Caldas' => elgg_echo('Caldas'),
        'Caquetá' => elgg_echo('Caquetá'),
        'Casanare' => elgg_echo('Casanare'),
        'Cauca' => elgg_echo('Cauca'),
        'Cesar' => elgg_echo('Cesar'),
        'Chocó' => elgg_echo('Chocó'),
        'Córdoba' => elgg_echo('Córdoba'),
        'Guainía' => elgg_echo('Guainía'),
        'Guaviare' => elgg_echo('Guaviare'),
        'La Guajira' => elgg_echo('La Guajira'),
        'Magdalena' => elgg_echo('Magdalena'),
        'Meta' => elgg_echo('Meta'),
        'Norte de Santander' => 'Norte de Santander',
        'Putumayo' => elgg_echo('Putumayo'),
        'Quindío' => elgg_echo('Quindío'),
        'Risaralda' => elgg_echo('Risaralda'),
        'San Andrés y Providencia' => elgg_echo('San Andrés y Providencia'),
        'Santander' => elgg_echo('Santander'),
        'Tolima' => elgg_echo('Tolima'),
        'Valle del Cauca' => elgg_echo('Valle del Cauca'),
        'Vaupés' => elgg_echo('Vaupés'),
        'Vichada' => elgg_echo('Vichada'),
    ),
    'onchange' => 'verConvocatorias4ByDpto(this)',
    'class' => 'select-reportes'
        ));




echo $select_departamento;
?>
<div id="conv">
   
</div>
<div id="result">

</div>

<script>
    function verConvocatorias4ByDpto(element){
        var departamento = $(element).val();
        $("#result").empty();
        elgg.get('ajax/view/reporte/convocatoria/participacion_grupos/convocatorias_by_dpto4', {
            timeout: 30000,
            data: {
                departamento: departamento
            },
            success: function(result, success, xhr) {
                $("#conv").html(result);
            },
        });

    }
    
</script>