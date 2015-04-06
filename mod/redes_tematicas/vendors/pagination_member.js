$(document).ready(function() {
    $(".pagination-item").live('click', function(evento) {
        var offset = $(this).attr('tittle');
        var clave= $('#busqueda_member').val();
        var red= $('#red').val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/redes_tematicas/ver_integrantes', {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                clave: clave,
                red: red,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });
    
    $('#busqueda_member').live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var offset = 0;
            var busqueda = $(this).val();
            var red= $('#red').val();
            $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
            elgg.get('ajax/view/redes_tematicas/ver_integrantes', {
                timeout: 30000,
                data: {
                    offset: offset,
                    ajax: 1,
                    clave: busqueda,
                    red: red,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#paginable').html(result);
                },
            });
        }
    });
});

