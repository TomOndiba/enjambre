var busqueda=0;
$(document).ready(function() {
    $(".pagination-item").live('click',function(evento) {
        var offset = $(this).attr('tittle');
        var id = $(this).attr('name');
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/evaluadores_feria/evaluadores_no_aceptados', {
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
    
});
