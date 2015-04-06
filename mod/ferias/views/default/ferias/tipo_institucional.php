<?php

/**
 * Vista que carga los selects de dpto - municipio - instituciones para almacenar la informacion de una feria
 * institucional.
 * @author DIEGOX_CORTEX
 */

elgg_load_js("mun-dpto");

$select_departamento = elgg_view('input/dropdown', array(
    'name' => 'departamentos',
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
<div id="instituciones">

</div>
<script>
    function verInstitiones(element) {
        var municipio = $(element).val();
        var dpto = $('#departamentos').val();
        elgg.get('ajax/view/ferias/selec_instituciones', {
            timeout: 30000,
            data: {
                municipio: municipio,
                departamento: dpto
            },
            success: function(result, success, xhr) {
                $("#instituciones").html(result);
            },
        });

    }

</script>

