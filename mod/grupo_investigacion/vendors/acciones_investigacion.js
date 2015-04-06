
$(document).ready(function(){

    $(".buscar").live('change',function() 
    { 
        
        $('#display').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        
        var cajabusqueda = $(this).val();
        var grupo = $(".grupo").val();
        var investigacion = $(".investigacion").val();
        
        if(cajabusqueda=='' || cajabusqueda=='0'){
            $('#display').hide();
            $('#href').show();
        }else{
            elgg.get('ajax/view/investigacion/lineas_convocatoria', {
                
                timeout: 30000,
                data: {
                    id: cajabusqueda,
                    id_grupo: grupo,
                    id_investigacion: investigacion,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display').html(result);
                    $('#href').hide();
                    $('#display').show();
                },
            });
        }
        return false;    
    });
    
    $(".buscar_linea").live('change', function() 
    { 
        
        $('#display1').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        
        var cajabusqueda = $(this).val();
        var grupo = $(".grupo").val();
        var investigacion = $(".investigacion").val();
        var convocatoria = $(".convocatoria").val();
        
        if(cajabusqueda=='' || cajabusqueda=='0'){
            $('#display1').hide();
            $('#href1').show();
        }else{
            elgg.get('ajax/view/investigacion/lineas_convocatoria_tipo', {
                
                timeout: 30000,
                data: {
                    tipo: cajabusqueda,
                    id_grupo: grupo,
                    id_investigacion: investigacion,
                    id_convocatoria: convocatoria,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display1').html(result);
                    $('#href1').hide();
                    $('#display1').show();
                },
            });
        }
        return false;    
    });
    
    $(".cargar-feria").live('change',function() 
    {   
         
        $('#display').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        
        var cajabusqueda = $(this).val();
        var grupo = $(".grupo").val();
        var investigacion = $(".investigacion").val();
        
        if(cajabusqueda=='' || cajabusqueda=='0'){
            $('#display').hide();
            $('#href').show();
        }else{
            elgg.get('ajax/view/investigacion/inscripcion_feria', {
                
                timeout: 30000,
                data: {
                    id: cajabusqueda,
                    id_grupo: grupo,
                    id_investigacion: investigacion,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display').html(result);
                    $('#href').hide();
                    $('#display').show();
                },
            });
        }
        return false;    
    });
    
});