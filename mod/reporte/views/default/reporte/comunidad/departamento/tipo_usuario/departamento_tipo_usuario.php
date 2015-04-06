
<h2 class="titulo-reportes title-legend">Tipo de Usuarios por Departamento</h2>
<br><label> Seleccione el Departamento que desea consultar</label>
<?php
/**
 * Vista ajax que muestra los departamentos para seleccionar y visualizar el reporte
 * @author DIEGOX_CORTEX
 */


$select_departamento = elgg_view('input/dropdown', array(
    'name' => 'dpto_tipo_usuario',
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
        'Norte de Santander' => elgg_echo('Norte de Santander'),
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
    'onchange' => 'verTipoUsuarioDepartamento(this)',
    'value' => $vars['departamento_n'],
    'class'=>'select-reportes'
        ));
echo $select_departamento;
?>
<div id="tablatipousuariodpto">

</div>
<script>
    function verTipoUsuarioDepartamento(element) {
        var departamento = $(element).val();
        elgg.get('ajax/view/reporte/comunidad/departamento/tipo_usuario/ver_tipo_usuario', {
            timeout: 30000,
            data: {
                dpto: departamento
            },
            success: function(result, success, xhr) {
                $("#tablatipousuariodpto").html(result);
            },
        });

    }

</script>