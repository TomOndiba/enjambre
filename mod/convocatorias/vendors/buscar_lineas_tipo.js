
$(document).ready(function(){

    $(".buscar_linea").live('change', function() 
    { 
        $('#display1').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        
        var cajabusqueda = $(this).val();
        var linea = $(".linea").val();
        var investigacion = $(".investigacion").val();
        var convocatoria = $(".convocatoria").val();
        
        if(cajabusqueda=='' || cajabusqueda=='0'){
            $('#display1').hide();
        }else{
            elgg.get('ajax/view/investigaciones/preinscritas/lineas_convocatoria_tipo', {
                
                timeout: 30000,
                data: {
                    tipo: cajabusqueda,
                    id_linea: linea,
                    id_investigacion: investigacion,
                    id_convocatoria: convocatoria,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display1').html(result);
                    $('#display1').show();
                },
            });
        }
        return false;    
    });
});