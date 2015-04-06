<h2 class="titulo-reportes title-legend">Reportes  de Convocatorias en la que ha participado un Grupo</h2>
<br><label> Seleccione el Departamento que desea consultar</label>
<?php
/**
 * Vista ajax que muestra los departamentos y municipios para seleccionar y visualizar el reporte
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
    'class'=>'select-reportes'
        ));



echo $select_departamento;
echo "<label>Municipio </label>";
echo $select_municipio;

?>
<label>Institución </label>
<div id="instituciones"> </div>


<div id="grupos2"> </div>


<div id="tablaconvgrupo">

</div>
<script>
  
    $(document).ready(function() {
     $("#inst").live("change", function(evento) {
        var inst = $("#inst").val();
       
        elgg.get('ajax/view/reporte/comunidad/grupo/listar_grupos_reporte', {
            timeout: 30000,
            data: {
                institucion: inst,
                id:"grupos-conv",
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#grupos2').html(result);
            },
        });

    });
    
    
      $("#grupos-conv").live("change", function(evento) {
        var grupo = $("#grupos-conv").val();
       
        elgg.get('ajax/view/reporte/grupo/convocatoria/reporte_conv_grupo', {
            timeout: 30000,
            data: {
                grupo: grupo,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#tablaconvgrupo').html(result);
            },
        });

    });
    
});

