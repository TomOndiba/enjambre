$(document).ready(function() {
    $('#respuesta').live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var comment = $(this).val();
            var annotation = $(this).attr('title');
            e.preventDefault();
            guardarComentario(comment,annotation);
            $(this).val("");
        }
    });
});
function pintarFormRespuesta(anotacion, element) {
    $(element).remove();
    elgg.get('ajax/view/discusiones/responder_discusion', {
        timeout: 30000,
        data: {
            annotation: anotacion,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#respuesta-pregunta-' + anotacion).html(result);
        },
    });
}

function guardarComentario(comentario, anotacion) {
    elgg.get('ajax/view/discusiones/add_respuesta', {
        timeout: 30000,
        data: {
            annotation: anotacion,
            comentario: comentario,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#respuesta-pregunta-nuevo-' + anotacion).append(result);
        },
    });
}