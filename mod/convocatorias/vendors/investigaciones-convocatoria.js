$(document).ready(function() {
    $(".ver-lista-investigaciones").live('click', function(evento) {
        var relacion = $(this).attr('name');
        var convocatoria = $('#convocatoria').val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/investigaciones/' + relacion + '/ver_' + relacion, {
            timeout: 30000,
            data: {
                ajax: 0,
                relacion: relacion,
                convocatoria: convocatoria,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#ajax-investigaciones').html(result);
                $(".selected").removeClass('selected');
                $("#" + relacion).addClass("selected");
            },
        });
    });

});


$(document).ready(function() {
    var src = String(window.location.href);
    var dir = src.split("#")[1];
    if (dir === "undefined") {
        cargarInvestigaciones('preinscritas');
    }
    else {
        cargarDefault(dir);
    }
    $('#linea').live('change', function() {
        var id_conv = $('#convocatoria').val();
        var relacion = $(".selected").attr('id');
        var linea = $(this).val();
        elgg.get('ajax/view/investigaciones/' + relacion + '/ver_' + relacion, {
            timeout: 30000,
            data: {
                ajax: 1,
                linea: linea,
                convocatoria: id_conv,
                relacion: relacion,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#investigaciones').html(result);
            },
        });
    });
});

function cargarDefault(dir) {
    if (dir === "preinscritas") {
        cargarInvestigaciones('preinscritas');
    } else if (dir === "inscritas") {
        cargarInvestigaciones('inscritas');
    } else if (dir === "seleccionadas") {
        cargarInvestigaciones("seleccionadas");
    } else if (dir === "preseleccionadas") {
        cargarInvestigaciones("preseleccionadas");
    } else {
        cargarInvestigaciones('preinscritas');
    }
}

function abrirform(value) {
    var investigacion = value;
    var id_conv = $('#convocatoria').val();
    elgg.get('ajax/view/investigaciones/inscritas/evaluadores/seleccionar_evaluador', {
        timeout: 30000,
        data: {
            ajax: 1,
            investigacion: investigacion,
            convocatoria: id_conv,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#content-pop-up').html(result);
        },
    });

}


function abrirformasesor(value) {
    var investigacion = value;
    var id_conv = $('#convocatoria').val();
    elgg.get('ajax/view/investigaciones/seleccionadas/asesores/seleccionar_asesor', {
        timeout: 30000,
        data: {
            ajax: 1,
            investigacion: investigacion,
            convocatoria: id_conv,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#content-pop-up').html(result);
        },
    });

}


function cargarInvestigaciones(relacion) {

    var convocatoria = $('#convocatoria').val();
    $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
    elgg.get('ajax/view/investigaciones/' + relacion + '/ver_' + relacion, {
        timeout: 30000,
        data: {
            ajax: 0,
            relacion: relacion,
            convocatoria: convocatoria,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#ajax-investigaciones').html(result);
            $(".selected").removeClass('selected');
            $("#" + relacion).addClass("selected");
        },
    });
}

function cargarModificarEvaluacion(guid){
    var investigacion = guid;
    elgg.get('ajax/view/investigaciones/preseleccionadas/modificar_evaluacion', {
        timeout: 30000,
        data: {
            ajax: 1,
            investigacion: investigacion,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#content-pop-up').html(result);
            sumar();
        },
    });
}
function abrirformActa(value) {
    var investigacion = value;
    var id_conv = $('#convocatoria').val();
    elgg.get('ajax/view/investigaciones/seleccionadas/acta_seleccion/acta_seleccion', {
        timeout: 30000,
        data: {
            ajax: 1,
            investigacion: investigacion,
            convocatoria: id_conv,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
             $('#content-pop-up-asesor').html(result);
        },
    });
}