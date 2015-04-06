var busqueda=0;
$(document).ready(function() {
    $(".pagination-item").live('click',function(evento) {
        var offset = $(this).attr('tittle');
        var id = $(this).attr('name');
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/redes_tematicas/listar_redes', {
            timeout: 30000,
            data: {
                busqueda:busqueda,
                offset: offset,
                ajax: 1,
                guid: id,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });
    
    
    $('#busqueda2').live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var offset = 0;
            busqueda = $(this).val();
            $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
            elgg.get('ajax/view/redes_tematicas/listar_redes', {
                timeout: 30000,
                data: {
                    offset: offset,
                    ajax: 1,
                    busqueda: busqueda,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#paginable').html(result);
                },
            });
        }
    });
    $("#button-busqueda-redes").live('click', function(evento) {
        var offset = 0;
        busqueda = $("#busqueda2").val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/redes_tematicas/listar', {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                busqueda: busqueda,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });
    
    
    
    
});