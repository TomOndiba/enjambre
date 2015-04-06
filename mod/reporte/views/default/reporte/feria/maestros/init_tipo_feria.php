<h2 class="titulo-reportes title-legend">Reporte de Maestros que participan en una Feria</h2>
<br><label> Seleccione un tipo para buscar la Feria.</label>
<?php
/**
 * Vista que muestra el listado de tipos de feria para mostrar todas las ferias según su tipo

 */
$select_tipo = elgg_view('input/dropdown', array(
    'name' => 'dpto_nacimiento',
    'class' => 'select',
    'options_values' => array(''=>'','Institucional' => 'Institucional',
        'Municipal' => 'Municipal',
        'Departamental' => 'Departamental',
        'Nacional' => 'Nacional'),
    'onchange' => 'verFeriasTipoM(this)',
    'class' => 'select-reportes'
        ));
echo $select_tipo;
?>



<div id="tipo-feria2"></div>

<div id="result">

</div>
<script>
    function verFeriasTipoM(element) {
        var tipo= $(element).val();
        elgg.get('ajax/view/reporte/feria/estudiantes/feria_tipo', {
            timeout: 30000,
            data: {
                tipo: tipo,
                id:"feria-maestro"
            },
            success: function(result, success, xhr) {
                $("#tipo-feria2").html(result);
            },
        });

    }
    
    
    $("#feria-maestro").live("change", function(evento) {
        var feria = $("#feria-maestro").val();
       
        elgg.get('ajax/view/reporte/feria/maestros/reporte_maestros_feria', {
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