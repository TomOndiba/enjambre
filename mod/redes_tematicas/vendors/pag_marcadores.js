var busqueda = 0;

$(document).ready(function() {
    $(".pagination-item").live('click', function(evento) {
        var offset = $(this).attr('tittle');
        var id = $(this).attr('name');
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/marcadores/ver_marcadores', {
            timeout: 30000,
            data: {
                busqueda: busqueda,
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
    
    
    $('#busqueda').live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var offset = 0;
            busqueda = $(this).val();
            var grupo = $(this).attr('title');
            $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
            elgg.get('ajax/view/marcadores/ver_marcadores', {
                timeout: 30000,
                data: {
                    offset: offset,
                    ajax: 1,
                    busqueda: busqueda,
                    guid: grupo,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#paginable').html(result);
                },
            });
        }
    });
    $("#button-busqueda-marcadores").live('click', function(evento) {
        var offset = 0;
        var grupo = $(this).attr('title');
        busqueda = $("#busqueda").val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/marcadores/ver_marcadores', {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                busqueda: busqueda,
                guid: grupo,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });

});

    