var busqueda = 0;
var categoria = "Caja de Herramientas";
$(document).ready(function() {
    $(".pagination-item").live('click', function(evento) {
        var offset = $(this).attr('tittle');
        var id = $(this).attr('name');
        var auto = $("#auto").val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/archivos/ver_archivos', {
            timeout: 30000,
            data: {
                busqueda: busqueda,
                offset: offset,
                ajax: 1,
                guid: id,
                categoria:categoria,
                autoformacion: auto,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });



    $('#busqueda').live("keypress", function(e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            var offset = 0;
            busqueda = $(this).val();
            var grupo = $(this).attr('title');
            var auto = $("#auto").val();
            $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
            elgg.get('ajax/view/archivos/ver_archivos', {
                timeout: 30000,
                data: {
                    categoria: categoria,
                    offset: offset,
                    ajax: 1,
                    busqueda: busqueda,
                    guid: grupo,
                    autoformacion: auto,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#paginable').html(result);
                },
            });
        }
    });
    $("#button-busqueda-archivos").live('click', function(evento) {
        var offset = 0;
        var grupo = $(this).attr('title');
        var auto = $("#auto").val();
        busqueda = $("#busqueda").val();
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/archivos/ver_archivos', {
            timeout: 30000,
            data: {
                categoria: categoria,
                offset: offset,
                ajax: 1,
                busqueda: busqueda,
                guid: grupo,
                autoformacion: auto,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
            },
        });
    });

});


$(document).ready(function() {
    var auto = $("#auto").val();
    var src = String(window.location.href);
    var dire = src.split("#")[1];
    if (dire === undefined) {
        if (auto === "true") {
            categoria = "Caja de Herramientas";
            cargarArchivos("Caja de Herramientas");
        }
        else{
            cargarArchivos('ninguna');
        }
    }
    else {
        cargarArchivos(dire);
    }



    $(".ver-lista-archivos").live('click', function(evento) {
        categoria = $(this).attr('name');
        var grupo = $(this).attr('title');
        var auto = $("#auto").val();
        var offset = 0;
        $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/archivos/ver_archivos', {
            timeout: 30000,
            data: {
                offset: offset,
                ajax: 1,
                categoria: categoria,
                guid: grupo,
                autoformacion: auto,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#paginable').html(result);
                $(".elgg-state-selected").removeClass('elgg-state-selected');
                $("#" + categoria).addClass("elgg-state-selected");
            },
        });
    });

});



function cargarArchivos(dir) {
    
    var auto = $("#auto").val();
    categoria = dir.replace("_", " ");
    categoria = categoria.replace("_", " ");
   
    var id= $("#falta").val();
    $('#paginable').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
    elgg.get('ajax/view/archivos/ver_archivos', {
        timeout: 30000,
        data: {
            offset: 0,
            ajax: 1,
            guid: id,
            categoria: categoria,
            autoformacion: auto,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#paginable').html(result);
        },
    });

}
