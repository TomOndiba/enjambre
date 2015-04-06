$(document).ready(function() {
    $(".pagination-item").live('click',function(evento) {
        var offset = $(this).attr('tittle');
        var inst = $(this).attr('name');
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/instituciones/ver_grupos', {
            timeout: 30000,
            data: {
                id_institucion:inst,
                offset: offset,
                ajax: 1,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });
    
    
});

