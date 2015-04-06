
<h2 class="titulo-reportes title-legend">Reportes  de Proyectos evaluados en una Convocatoria por un Evaluador</h2>
<br><label> Seleccione el Departamento </label>
<?php
/**
 * Vista ajax que muestra los departamentos y municipios para seleccionar y visualizar el reporte
 * @author Erika Parra
 * 
 */
elgg_load_js("mun-dpto");

$select_departamento = elgg_view('input/dropdown', array(
    'name' => 'departamento',
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
    'id' => 'departamentos',
    'class'=>'select-reportes',
    'onchange' => 'verConvocatorias(this)',
        ));

echo $select_departamento;
?>

<div id="conv-dpto"> 

</div>

<div id="evaluador-conv"> 

</div>

<div id="result"></div>


<script>
    
    function verConvocatorias(element){
        
        var dpto=$(element).val();
        elgg.get('ajax/view/reporte/evaluador/proyectos_evaluados_convocatoria/convocatorias_por_dpto', {
            timeout: 30000,
            data: {
                dpto: dpto,
                
            },
            success: function(result, success, xhr) {
                $("#conv-dpto").html(result);
            },
        });
        
    }
    
    
    
</script>
