$(document).ready(function() {
    $(document).on('click', ".pagination-item", function(e) {
        var offset = $(this).attr('tittle');
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/revistas/listar_revistas_2', {
            timeout: 30000,
            data: {
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