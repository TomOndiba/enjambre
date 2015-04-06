$(document).ready(function() {
    $("input[type='number']").live('change',(function() {
        var sumaTotal = 0;

        sumaTotal = Number($("input[id='puntaje_visible_reflexiones']").val());
        sumaTotal += Number($("input[id='puntaje_practica_pedagogica']").val());
        sumaTotal += Number($("input[id='puntaje_aprendizajes_propios']").val());
        sumaTotal += Number($("input[id='puntaje_reflexion_presentada']").val());

        $("#puntaje_totalMO").val(sumaTotal);
    }));

    $("input[type='number']").live('keyup',(function() {
        var sumaTotal = 0;

        sumaTotal = Number($("input[id='puntaje_visible_reflexiones']").val());
        sumaTotal += Number($("input[id='puntaje_practica_pedagogica']").val());
        sumaTotal += Number($("input[id='puntaje_aprendizajes_propios']").val());
        sumaTotal += Number($("input[id='puntaje_reflexion_presentada']").val());

        $("#puntaje_totalMO").val(sumaTotal);
    }));

    $("input[type='number']").live('change',(function() {

        var puntaje_visible_reflexiones = Number($("input[id='puntaje_visible_reflexiones']").val());
        if (puntaje_visible_reflexiones > 3 || puntaje_visible_reflexiones < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_visible_reflexiones").val('');
        }
        var puntaje_practica_pedagogica = Number($("input[id='puntaje_practica_pedagogica']").val());
        if (puntaje_practica_pedagogica > 3 || puntaje_practica_pedagogica < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_practica_pedagogica").val('');
        }
        var puntaje_aprendizajes_propios = Number($("input[id='puntaje_aprendizajes_propios']").val());
        if (puntaje_aprendizajes_propios > 2 || puntaje_aprendizajes_propios < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_aprendizajes_propios").val('');
        }
        var puntaje_reflexion_presentada = Number($("input[id='puntaje_reflexion_presentada']").val());
        if (puntaje_reflexion_presentada > 2 || puntaje_reflexion_presentada < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_reflexion_presentada").val('');
        }

    }));
    $("input[type='number']").live('keyup',(function() {
        var puntaje_visible_reflexiones = Number($("input[id='puntaje_visible_reflexiones']").val());
        if (puntaje_visible_reflexiones > 3 || puntaje_visible_reflexiones < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_visible_reflexiones").val('');
        }
        var puntaje_practica_pedagogica = Number($("input[id='puntaje_practica_pedagogica']").val());
        if (puntaje_practica_pedagogica > 3 || puntaje_practica_pedagogica < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_practica_pedagogica").val('');
        }
        var puntaje_aprendizajes_propios = Number($("input[id='puntaje_aprendizajes_propios']").val());
        if (puntaje_aprendizajes_propios > 2 || puntaje_aprendizajes_propios < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_aprendizajes_propios").val('');
        }
        var puntaje_reflexion_presentada = Number($("input[id='puntaje_reflexion_presentada']").val());
        if (puntaje_reflexion_presentada > 2 || puntaje_reflexion_presentada < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_reflexion_presentada").val('');
        }
    }));
});

 



