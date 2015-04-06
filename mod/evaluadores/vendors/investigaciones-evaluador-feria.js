$(document).ready(function() {
    $(".ver-lista-investigaciones-feria").live('click', function(evento) {
        var src = String(window.location.href);
        var dir = src.split("#")[1];
        var id = $(this).attr('id');
        var name = $(this).attr('name');
        elgg.get('ajax/view/investigaciones_feria_asignadas/ver_investigaciones', {
            timeout: 30000,
            data: {
                ajax: 1,
                relacion: id,
                name: name,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#ajax-investigaciones0').html(result);
                $(".selected").removeClass("selected");
                $("#" + dir).addClass("selected");
                cargarInvestigaciones('investigaciones_inicial', 'municipal-inicial');
            },
        });
    });

});


$(document).ready(function() {
    var src = String(window.location.href);
    var dir = src.split("#")[1];
    if (dir === "undefined") {
        cargarInvestigaciones('mun', 'municipal', 'municipal');
    }
    else {
        cargarDefault(dir);
    }
});

function cargarDefault(dir) {
    if (dir === "municipal") {
        cargarInvestigaciones('mun', 'municipal', dir);
    } else if (dir === "departamental") {
        cargarInvestigaciones('dptal', 'departamental', dir);
    }else{
        cargarInvestigaciones('mun', 'municipal', dir);
    }
}

function cargarInvestigaciones(id, name, dir) {
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/investigaciones_feria_asignadas/ver_investigaciones', {
            timeout: 30000,
            data: {
                ajax: 1,
                relacion: id,
                name: name,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#ajax-investigaciones0').html(result);
                $(".selected").removeClass('selected');
                $("#" + dir).addClass("selected");
            },
    });
}
