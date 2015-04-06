<h2 class="titulo-reportes title-legend">Reporte de Investigaciones de una Feria</h2>
<br><label> Seleccione un tipo para buscar la Feria.</label>
<?php
/**
 * Vista que muestra el listado de tipos de feria  para consultar  ferias
 */
$select_tipo = elgg_view('input/dropdown', array(
    'name' => 'dpto_nacimiento',
    'class' => 'select',
    'options_values' => array(''=>'','Institucional' => 'Institucional',
        'Municipal' => 'Municipal',
        'Departamental' => 'Departamental',
        'Nacional' => 'Nacional'),
    'onchange' => 'verFeriasTipoI(this)',
    'class' => 'select-reportes'
        ));
echo $select_tipo;
?>



<div id="tipo-feria-inv"></div>

<div id="result">

</div>
<script>
    function verFeriasTipoI(element) {
        var tipo= $(element).val();
        elgg.get('ajax/view/reporte/feria/estudiantes/feria_tipo', {
            timeout: 30000,
            data: {
                tipo: tipo,
                id:"feria-inv"
            },
            success: function(result, success, xhr) {
                $("#tipo-feria-inv").html(result);
            },
        });

    }
    
    
    $("#feria-inv").live("change", function(evento) {
        var feria = $("#feria-inv").val();
       
        elgg.get('ajax/view/reporte/feria/investigaciones/reporte_investigaciones_feria', {
            timeout: 30000,
            data: {
                feria: feria,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#result').html(result);
            },
        });

    });

</script>