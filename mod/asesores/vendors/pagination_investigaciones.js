var busqueda=0;
$(document).ready(function() {
    $(".pagination-item").live('click',function(evento) {
        var offset = $(this).attr('tittle');
        var id_conv = $(this).attr('name');
        var id_inv = $(this).attr('id');
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/asesorias/cronograma', {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                id_inv: id_inv,
                id_conv:id_conv,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });
    
});
