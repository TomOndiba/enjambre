$(document).ready(function(){

    $(".buscar").keyup(function() 
    { 
        
        $('#display').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        var cajabusqueda = $(this).val();
        var dataString = cajabusqueda;
        var id_conv= document.getElementById('id_conv').value;
        var id_evento= document.getElementById('id_evento').value;
        
        if(cajabusqueda==''){
            $('#display').hide();
        }else{
        
            elgg.get('ajax/view/eventos/buscar', {
                
                timeout: 30000,
                data: {
                    id: dataString,
                    id_conv: id_conv,
                    id_evento: id_evento,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display').html(result);
                    $('#display').show();
                },
            });
        }
        return false;    
    });
});