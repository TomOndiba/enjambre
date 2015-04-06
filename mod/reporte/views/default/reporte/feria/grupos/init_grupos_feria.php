<h2 class="titulo-reportes title-legend">Reporte de Grupos de una Feria</h2>
<br><label> Seleccione un tipo para buscar la Feria.</label>
<?php
/**
 * Vista que muestra el listado de dpto's  para consultar el listado de convocatorias
 * @author DIEGOX_CORTEX
 */
$select_tipo = elgg_view('input/dropdown', array(
    'name' => 'dpto_nacimiento',
    'class' => 'select',
    'options_values' => array(''=>'','Institucional' => 'Institucional',
        'Municipal' => 'Municipal',
        'Departamental' => 'Departamental',
        'Nacional' => 'Nacional'),
    'onchange' => 'verFeriasTipoG(this)',
    'class' => 'select-reportes'
        ));
echo $select_tipo;
?>



<div id="tipo-feria-grupo"></div>

<div id="result">

</div>
<script>
    function verFeriasTipoG(element) {
        var tipo= $(element).val();
        elgg.get('ajax/view/reporte/feria/estudiantes/feria_tipo', {
            timeout: 30000,
            data: {
                tipo: tipo,
                id:"feria-grupo"
            },
            success: function(result, success, xhr) {
                $("#tipo-feria-grupo").html(result);
            },
        });

    }
    
    
    $("#feria-grupo").live("change", function(evento) {
        var feria = $("#feria-grupo").val();
       
        elgg.get('ajax/view/reporte/feria/grupos/reporte_grupos_feria', {
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