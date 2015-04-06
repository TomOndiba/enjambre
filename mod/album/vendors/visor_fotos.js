$(document).ready(function() {
    $(".foto").live('click', function() {
        var foto= $(this).attr('title');
        elgg.get('ajax/view/foto/ver_foto', {
            timeout: 30000,
            data: {
                foto: foto,
                pageowner: elgg.get_page_owner_guid(),
            },
            success: function(result, success, xhr) {
                $('.pop-up-foto').html(result);
            },
        });
    });
    $("#input-comentario-foto").live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var comment = $(this).val();
            var owner = $(this).attr('title');
            addComentarioFoto(owner, comment);
            $(this).val("");
        }
    });
});

$(document).bind('keydown', function(e) {
    if (e.which == 27) {
       $(".visor-fotos").hide();
    }
    ;
});

function addComentarioFoto(owner, comment) {
    elgg.get('ajax/view/foto/comentarios/add_comment', {
        timeout: 30000,
        data: {
            foto: owner,
            comentario: comment,
            pageowner: elgg.get_page_owner_guid(),
        },
        success: function(result, success, xhr) {
            if($('#nuevos-comentarios').html()=="No existen comentarios en la foto"){
                $('#nuevos-comentarios').html("");
            }
            $('#nuevos-comentarios').prepend(result);
        },
    });
}