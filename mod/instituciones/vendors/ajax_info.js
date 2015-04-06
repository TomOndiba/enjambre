$(document).ready(function() {
    $("#ver-mas").live('click', function(evento) {
        var offset = $(this).attr('tittle');
        var grupo = $(this).attr('name');
        $(this).remove();
        elgg.get('ajax/view/messageboard/ver_publicaciones_muro', {
            timeout: 30000,
            data: {
                id_grupo: grupo,
                offset: offset,
                limit: 12,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#message-board-body').append(result);
            },
        });
    });
   
    $(".ver-todos-comments").live('click', function(evento) {
        var padre = $(this).attr('tittle');
        $("."+padre).css("display", "block");
        $(this).remove();
    });
    
    $(window).scroll(function() {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            //vermas();
        }
    });

    $('.txt-comment').live("keypress", function(e) {
        if (e.keyCode==13 && !e.shiftKey) {
            var comment= $(this).val();
            var annotation= $(this).attr('tittle');
            e.preventDefault();
            addComment(annotation, comment);
            $(this).val("");
        }   
    });
    
    $('.txt-post').live("keypress", function(e) {
        if (e.keyCode==13 && !e.shiftKey) {
            var comment= $(this).val();
            var owner= $("#owner").val();
            e.preventDefault();
            addPost(owner, comment);
            $(this).val("");
        }   
    });

});

function vermas() {
    var offset = $("#ver-mas").attr('tittle');
    var grupo = $("#ver-mas").attr('name');
    $("#ver-mas").remove();
    elgg.get('ajax/view/messageboard/ver_publicaciones_muro', {
        timeout: 30000,
        data: {
            id_grupo: grupo,
            offset: offset,
            limit: 12,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#message-board-body').append(result);
        },
    });
}

function addComment(annotation, comment){
    alert('anotacion'+annotation);
    elgg.get('ajax/view/messageboard/add_comment', {
        timeout: 30000,
        
        data: {
            owner_guid: annotation,
            message_content: comment,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('.comentarios-post#'+annotation).append(result);
        },
    });
}

function addPost(owner, comment){
    elgg.get('ajax/view/messageboard/add', {
        timeout: 30000,
        
        data: {
            owner_guid: owner,
            message_content: comment,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $("#message-board-body").prepend(result);
        },
    });
}


