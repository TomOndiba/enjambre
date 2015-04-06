$(document).ready(function() {
    $("#input-comentario").live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var comment = $(this).val();
            var owner = $(this).attr('title');
            addComentario(owner, comment);
            $(this).val("");
        }
    });
     $("#link-like").live("click", function(e) {           
            var owner = $(this).attr('title');
            addLike(owner);
        
    });
     $("#link-like-anotacion").live("click", function(e) {           
            var owner = $(this).attr('title');
            addLikeAnotacion(owner);
        
    });
     $("#link-no-like-anotacion").live("click", function(e) {           
            var owner = $(this).attr('title');
            var comment = $(this).attr('class');
            removeLikeAnotacion(owner, comment);
        
    });
    $("#link-no-like").live("click", function(e) {           
            var id = $(this).attr('title');
            removeLike(id);
        
    });
});


function addComentario(owner, comment) {
    elgg.get('ajax/view/comentarios/add_comment', {
        timeout: 30000,
        data: {
            entity: owner,
            comentario: comment,
        },
        success: function(result, success, xhr) {
            $('.lista-comentarios-entities').append(result);
        },
    });
}

function addLike(owner) {
    elgg.get('ajax/view/like/add_like_entity', {
        timeout: 30000,
        data: {
            entity: owner,
        },
        success: function(result, success, xhr) {
            $('.like-entity').html(result);
        },
    });
}

function addLikeAnotacion(owner) {
    elgg.get('ajax/view/like/add_like_annotation', {
        timeout: 30000,
        data: {
            anotacion: owner,
        },
        success: function(result, success, xhr) {
            $('.like-anotacion-'+owner).html(result);
        },
    });
}


function removeLikeAnotacion(owner, comment) {
    elgg.get('ajax/view/like/remove_like_annotation', {
        timeout: 30000,
        data: {
            anotacion: owner,
            owner:comment
        },
        success: function(result, success, xhr) {
            $('.like-anotacion-'+comment).html(result);
        },
    });
}


function removeLike(id) {
    elgg.get('ajax/view/like/remove_like_entity', {
        timeout: 30000,
        data: {
            id: id,
        },
        success: function(result, success, xhr) {
            $('.like-entity').html(result);
        },
    });
}