$(document).ready(function() {
    
    var offset = $(this).attr('tittle');
    elgg.get('ajax/view/investigaciones_feria_asignadas/lista_ferias_mun_evaluador',{
        timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                pageowner: elgg.get_page_owner_guid(),
                
            },
            success: function(result, success, xhr) {
                $('#ajax-ferias0').html(result);
            },
    });
    
    $(".pagination-item").live('click', function(evento) {
        var offset = $(this).attr('tittle');
        var tipo= $("#tipo").val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        var url='ajax/view/investigaciones_feria_asignadas/lista_ferias_mun_evaluador';
        if(tipo==="mun"){
            url='ajax/view/investigaciones_feria_asignadas/lista_ferias_mun_evaluador';
        }else if(tipo==="dptal"){
            url='ajax/view/investigaciones_feria_asignadas/lista_ferias_dep_evaluador';
        }
        
        elgg.get(url, {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#ajax-ferias0').html(result);
            },
        });
    });
});

function get_ferias_mun_evaluador(ev){
    
    elgg.get('ajax/view/investigaciones_feria_asignadas/lista_ferias_mun_evaluador',{
        timeout: 30000,
            data: {
                //offset: offset,
                ajax: 1,
                pageowner: elgg.get_page_owner_guid(),
                
            },
            success: function(result, success, xhr) {
                $('#ajax-ferias0').html(result);
                $(".selected").removeClass("selected");
                $("#mun").addClass("selected");
            },
    });
    
}

function get_ferias_dep_evaluador(ev){
    
    elgg.get('ajax/view/investigaciones_feria_asignadas/lista_ferias_dep_evaluador',{
        timeout: 30000,
            data: {
                //offset: offset,
                ajax: 1,
                pageowner: elgg.get_page_owner_guid(),
                
            },
            success: function(result, success, xhr) {
                $('#ajax-ferias0').html(result);
                $(".selected").removeClass("selected");
                $("#dptal").addClass("selected");
            },
    });

}


