$(document).ready(function() {
    $(".pagination-item").live('click', function(evento) {
        var offset = $(this).attr('tittle');
        var clave= $('#busqueda_integrante').val();
        var institucion= $('#institucion').val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/instituciones/ver_integrantes', {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                clave: clave,
                institucion: institucion,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });
    
    $('#busqueda_integrante').live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var offset = 0;
            var busqueda = $(this).val();
            var institucion= $('#institucion').val();
            $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
            elgg.get('ajax/view/instituciones/ver_integrantes', {
                timeout: 30000,
                data: {
                    offset: offset,
                    ajax: 1,
                    clave: busqueda,
                    institucion: institucion,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#paginable').html(result);
                },
            });
        }
    });
});

