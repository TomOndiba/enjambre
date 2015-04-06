<h2 class="titulo-reportes title-legend">Reportes Por Municipio</h2>
<br><label> Seleccione el Departamento y Municipio que desea consultar</label>
<?php
/**
 * Vista ajax que muestra los departamentos y municipios para seleccionar y visualizar el reporte
 * @author DIEGOX_CORTEX
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
    'class'=>'select-reportes'
        ));




$select_municipio = elgg_view('input/dropdown', array(
    'name' => 'municipio',
    'class'=>'select',
    'id' => 'municipios',
    'onchange' => 'verDptoMunic(this)',
    'class'=>'select-reportes'
        ));



echo $select_departamento;
echo $select_municipio;
?>
<div id="tablatipousuariodpto">

</div>
<script>
    function verDptoMunic(element) {
        var municipio = $(element).val();
        $("#tablatipousuariodpto").html(imprimirLoader());
        elgg.get('ajax/view/reporte/comunidad/municipio/reporte_municipio', {
            timeout: 30000,
            data: {
                munic: municipio
            },
            success: function(result, success, xhr) {
                $("#tablatipousuariodpto").html(result);
            },
        });

    }

</script>



