/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    cargar();
    $(".tab-evaluadores").live('click', function(evento) {
        var tipo = $(this).attr('name');
        $(".selected").removeClass('selected');
        $("#" + tipo).addClass("selected");
        cambiar(tipo);
        $('.' + tipo).show();
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
