/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    cargar();
    $(".tab-asesores").live('click', function(evento) {
        var tipo = $(this).attr('name');
        $(".selected").removeClass('selected');
        $("#" + tipo).addClass("selected");
        cambiar(tipo);
        $('.' + tipo).show();
    });

    $("#evaluar").live('click', function(e) {
        $("#evaluar_asesor").dialog({
            autoOpen: false, // no abrir automáticamente
            resizable: false, //permite cambiar el tamaño
            height: "auto", // altura
            width: 900,
            modal: true, //capa principal, fondo opaco
        });
        var id_conv = $('#convocatoria').val();
        $('#evaluar_asesor').dialog('open');
        var asesor=$(this).attr("title");
        elgg.get('ajax/view/asesores/add_asesor', {
            timeout: 30000,
            data: {
                ajax: 1,
                convocatoria: id_conv,
                asesor: asesor,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#evaluar_asesor').html(result);
            },
        });
    });
});

function cargar() {
    $('.no-asignados').hide();
}

function cambiar(tipo) {
    if (tipo === "no-asignados") {
        $('.asignados').hide();
    } else {
        $('.no-asignados').hide();
    }
}
