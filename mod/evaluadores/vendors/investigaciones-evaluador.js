$(document).ready(function() {
    $(".ver-lista-investigaciones").live('click', function(evento) {
        var relacion = $(this).attr('name');
        var id = $(this).attr('id');
        var evaluador = $('#evaluador').val();
        var feria = $('#feria').val();
        var relation = $('#relation').val();
        var name = $('#namee').val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/investigaciones_feria_asignadas/' + relacion + '/ver_' + relacion, {
            timeout: 30000,
            data: {
                ajax: 1,
                evaluador: evaluador,
                participa: name,
                relacion: relacion,
                relation: relation,
                guid_feria: feria,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#ajax-investigaciones1').html(result);
                $(".selected").removeClass('selected');
                $("#" + id).addClass("selected");
            },
        });
    });

});


$(document).ready(function() {
    var src = String(window.location.href);
    var dir = src.split("#")[1];
    if (dir === "undefined") {
        cargarInvestigaciones('investigaciones_inicial', 'inicial');
    }
    else {
        cargarDefault(dir);
    }
});

function cargarDefault(dir) {
    if (dir === "inicial") {
        cargarInvestigaciones('investigaciones_inicial', 'inicial');
    } else if (dir === "en_sitio") {
        cargarInvestigaciones('investigaciones_en_sitio', 'en_sitio');
    }else{
        cargarInvestigaciones('investigaciones_inicial', 'inicial');
    }
}

function cargarInvestigaciones(relacion, id) {
    var evaluador = $('#evaluador').val();
    var relation = $('#relation').val();
    var feria = $('#feria').val();
    var name = $('#namee').val();
    //alert(evaluador);alert(relation);alert(feria);alert(name);
    $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
    elgg.get('ajax/view/investigaciones_feria_asignadas/' + relacion + '/ver_' + relacion, {
        timeout: 30000,
        data: {
            ajax: 1,
            evaluador: evaluador,
            relacion: relacion,
            relation: relation,
            guid_feria: feria,
            participa: name,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#ajax-investigaciones1').html(result);
            $(".selected").removeClass('selected');
            $("#" + id).addClass("selected");
        },
    });
}