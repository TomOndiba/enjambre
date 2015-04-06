$(document).ready(function(){

     $(".buscar_maestros").live('keyup',function() 
    { 
        
        $('#display2').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        var cajabusqueda = $(this).val();
        var dataString = cajabusqueda;
        var id_grupo= document.getElementById('id_grupo').value;
        var id_cuad=document.getElementById('id_cuad').value;
        
        
        if(cajabusqueda==''){
            $('#display2').hide();
        }else{
        
            elgg.get('ajax/view/cuaderno_campo/mostrar_maestros', {
                
                timeout: 30000,
                data: {
                    id: dataString,
                    id_grupo: id_grupo,
                    id_cuad: id_cuad,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display2').html(result);
                    $('#display2').show();
                },
            });
        }
        return false;    
        
    });
    
    
     
});


        
       