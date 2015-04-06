$(document).ready(function() {
    $("#ver-mas-fotos").live("click", function() {
        var offset = $(this).attr('title');
        var album = $(this).attr('name');
        $(this).remove();
        elgg.get('ajax/view/album/ver_album', {
            timeout: 30000,
            data: {
                ajax: 1,
                album:album,
                offset: offset,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#fotos-ajax').append(result);
            },
        });
    });
   $("#button-add-fotos").live("click", function(){
       $("#add-fotos").show();
   }); 
    
});