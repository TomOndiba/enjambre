
<h2 class="titulo-reportes title-legend">Reportes  de Proyectos evaluados en una Feria por un Evaluador</h2>
<br><label> Seleccione un tipo para buscar la Feria.</label>
<?php
/**
 * Vista que muestra el listado de dpto's  para consultar el listado de convocatorias
 * @author Erika Parra
 */
$select_tipo = elgg_view('input/dropdown', array(
    'name' => 'dpto_nacimiento',
    'class' => 'select',
    'options_values' => array(''=>'','Institucional' => 'Institucional',
        'Municipal' => 'Municipal',
        'Departamental' => 'Departamental',
        'Nacional' => 'Nacional'),
    'onchange' => 'verFeriasTipoE(this)',
    'class' => 'select-reportes'
        ));
echo $select_tipo;
?>



<div id="tipo-feria-evaluador"> 

</div>

<div id="evaluador-feria"> 

</div>

<div id="result"></div>


<script>
    
    function verFeriasTipoE(element){
        
        var tipo=$(element).val();
         elgg.get('ajax/view/reporte/feria/estudiantes/feria_tipo', {
            timeout: 30000,
            data: {
                tipo: tipo,
                id:"feria-evaluador"
            },
            success: function(result, success, xhr) {
                $("#tipo-feria-evaluador").html(result);
            },
        });
        
    }
    
    
     $("#feria-evaluador").live("change", function(evento) {
        var feria = $("#feria-evaluador").val();
       
        elgg.get('ajax/view/reporte/evaluador/proyectos_evaluados_feria/evaluadores_por_feria', {
            timeout: 30000,
            data: {
                feria: feria,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#evaluador-feria').html(result);
            },
        });

    });
    
    
</script>
