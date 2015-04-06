$(document).ready(function() {
    $(".ver-lista-investigaciones").live('click', function(evento) {
        var relacion = $(this).attr('name');
        var feria = $('#feria').val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/investigaciones_feria/' + relacion + '/ver_' + relacion, {
            timeout: 30000,
            data: {
                ajax: 0,
                relacion: relacion,
                feria: feria,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#ajax-investigaciones1').html(result);
                $(".selected").removeClass('selected');
                $("#" + relacion).addClass("selected");
            },
        });
    });

});


$(document).ready(function() {
    var src = String(window.location.href);
    var dir = src.split("#")[1];
    var tipo_feria = $('#tipo_feria').val();
    if (dir === "undefined") {
        if(tipo_feria==='Municipal'){
            cargarInvestigaciones('inscritas');
        }else if(tipo_feria==='Departamental'){
            cargarInvestigaciones('acreditadas');
        }
    }
    else {
        cargarDefault(dir, tipo_feria);
    }
});

function cargarDefault(dir, tipo_feria) {
    if (dir === "inscritas") {
        cargarInvestigaciones('inscritas');
    } else if (dir === "acreditadas") {
        cargarInvestigaciones('acreditadas');
    } else if (dir === "evaluadas_inicialmente") {
        cargarInvestigaciones('evaluadas_inicialmente');
    } else if (dir === "evaluadas_en_sitio") {
        cargarInvestigaciones('evaluadas_en_sitio');
    } else if (dir === "finalistas") {
        cargarInvestigaciones('finalistas');
    }else{
        if(tipo_feria==='Municipal'){
            cargarInvestigaciones('inscritas');
        }else if(tipo_feria==='Departamental'){
            cargarInvestigaciones('acreditadas');
        }
    }
}

function cargarInvestigaciones(relacion) {
    var feria = $('#feria').val();
    $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
    elgg.get('ajax/view/investigaciones_feria/' + relacion + '/ver_' + relacion, {
        timeout: 30000,
        data: {
            ajax: 0,
            relacion: relacion,
            feria: feria,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#ajax-investigaciones1').html(result);
            $(".selected").removeClass('selected');
            $("#" + relacion).addClass("selected");
        },
    });
}

function abrirform(value) {
    var investigacion = value;
    var tipo_eval='inicial';
    $("#dialog_eval").dialog({
        autoOpen: false, // no abrir automáticamente
        resizable: false, //permite cambiar el tamaño
        height: "auto", // altura
        width: 900,
        modal: true, //capa principal, fondo opaco
    });
    var id_feria = $('#feria').val();
    $('#dialog_eval').dialog('open');
    elgg.get('ajax/view/investigaciones_feria/acreditadas/evaluadores/seleccionar_evaluador', {
        timeout: 30000,
        data: {
            ajax: 1,
            investigacion: investigacion,
            feria: id_feria,
            tipo: tipo_eval,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#dialog_eval').html(result);
        },
    });

}


function abrirform2(value) {
    var investigacion = value;
    var tipo_eval='en sitio';
    $("#dialog_eval").dialog({
        autoOpen: false, // no abrir automáticamente
        resizable: false, //permite cambiar el tamaño
        height: "auto", // altura
        width: 900,
        modal: true, //capa principal, fondo opaco
    });
    
    var id_feria = $('#feria').val();
    $('#dialog_eval').dialog('open');
    elgg.get('ajax/view/investigaciones_feria/evaluadas_inicialmente/evaluadores_sitio/seleccionar_evaluador', {
        timeout: 30000,
        data: {
            ajax: 1,
            investigacion: investigacion,
            feria: id_feria,
            tipo: tipo_eval,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#dialog_eval').html(result);
        },
    });

}