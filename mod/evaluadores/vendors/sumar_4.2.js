$(document).ready(function() {
    $("input[type='number']").live('change', (function() {
        var sumaTotalINNinv = 0;
        var sumaCoherenciaINNinv = 0;
        var sumaRutaINNinv = 0;
        var sumaFuentesINNinv = 0;
        //COHERENCIA
        sumaCoherenciaINNinv = Number($("input[id='puntaje_trabajo_colaborativoINNinv']").val());
        sumaCoherenciaINNinv += Number($("input[id='puntaje_claridad_preguntaINNinv']").val());
        $("#subtotal_coherenciaINNinv").val(sumaCoherenciaINNinv);

        //RUTA_INDAGACION
        sumaRutaINNinv = Number($("input[id='puntaje_diseño_metodologicoINNinv']").val());
        sumaRutaINNinv += Number($("input[id='puntaje_conceptos_investigacionINNinv']").val());
        sumaRutaINNinv += Number($("input[id='puntaje_resultados_clarosINNinv']").val());
        $("#subtotal_rutaINNinv").val(sumaRutaINNinv);

        //FUENTES
        sumaFuentesINNinv = Number($("input[id='puntaje_forma_adecuadaINNinv']").val());
        $("#subtotal_fuentesINNinv").val(sumaFuentesINNinv);


        sumaTotalINNinv = sumaCoherenciaINNinv + sumaRutaINNinv + sumaFuentesINNinv;
        
        $("#puntaje_totalINNinv").val(sumaTotalINNinv);
    }));

    $("input[type='number']").live('keyup', (function() {
        var sumaTotalINNinv = 0;
        var sumaCoherenciaINNinv = 0;
        var sumaRutaINNinv = 0;
        var sumaFuentesINNinv = 0;
        //COHERENCIA
        sumaCoherenciaINNinv = Number($("input[id='puntaje_trabajo_colaborativoINNinv']").val());
        sumaCoherenciaINNinv += Number($("input[id='puntaje_claridad_preguntaINNinv']").val());
        $("#subtotal_coherenciaINNinv").val(sumaCoherenciaINNinv);

        //RUTA_INDAGACION
        sumaRutaINNinv = Number($("input[id='puntaje_diseño_metodologicoINNinv']").val());
        sumaRutaINNinv += Number($("input[id='puntaje_conceptos_investigacionINNinv']").val());
        sumaRutaINNinv += Number($("input[id='puntaje_resultados_clarosINNinv']").val());
        $("#subtotal_rutaINNinv").val(sumaRutaINNinv);

        //FUENTES
        sumaFuentesINNinv = Number($("input[id='puntaje_forma_adecuadaINNinv']").val());
        $("#subtotal_fuentesINNinv").val(sumaFuentesINNinv);


        sumaTotalINNinv = sumaCoherenciaINNinv + sumaRutaINNinv + sumaFuentesINNinv;
        
        $("#puntaje_totalINNinv").val(sumaTotalINNinv);
    }));

    $("input[type='number']").live('change', (function() {

        //COHERENCIA
        var puntaje_trabajo_colaborativo = Number($("input[id='puntaje_trabajo_colaborativoINNinv']").val());
        if (puntaje_trabajo_colaborativo > 8 || puntaje_trabajo_colaborativo < 0) {
            alert('Recuerde que este campo es de 0 a 8');
            $("#puntaje_trabajo_colaborativoINNinv").val('');
        }
        var puntaje_claridad_pregunta = Number($("input[id='puntaje_claridad_preguntaINNinv']").val());
        if (puntaje_claridad_pregunta > 8 || puntaje_claridad_pregunta < 0) {
            alert('Recuerde que este campo es de 0 a 8');
            $("#puntaje_claridad_preguntaINNinv").val('');
        }

        //RUTA_INDAGACION
        var puntaje_diseño_metodologico = Number($("input[id='puntaje_diseño_metodologicoINNinv']").val());
        if (puntaje_diseño_metodologico > 10 || puntaje_diseño_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 10');
            $("#puntaje_diseño_metodologicoINNinv").val('');
        }
        var puntaje_conceptos_investigacion = Number($("input[id='puntaje_conceptos_investigacionINNinv']").val());
        if (puntaje_conceptos_investigacion > 10 || puntaje_conceptos_investigacion < 0) {
            alert('Recuerde que este campo es de 0 a 10');
            $("#puntaje_conceptos_investigacionINNinv").val('');
        }
        var puntaje_resultados_claros = Number($("input[id='puntaje_resultados_clarosINNinv']").val());
        if (puntaje_resultados_claros > 10 || puntaje_resultados_claros < 0) {
            alert('Recuerde que este campo es de 0 a 10');
            $("#puntaje_resultados_clarosINNinv").val('');
        }

        //FUENTES
        var puntaje_forma_adecuada = Number($("input[id='puntaje_forma_adecuadaINNinv']").val());
        if (puntaje_forma_adecuada > 5 || puntaje_forma_adecuada < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_forma_adecuadaINNinv").val('');
        }
    }));
    $("input[type='number']").keyup(function() {
        //COHERENCIA
        var puntaje_trabajo_colaborativo = Number($("input[id='puntaje_trabajo_colaborativoINNinv']").val());
        if (puntaje_trabajo_colaborativo > 8 || puntaje_trabajo_colaborativo < 0) {
            alert('Recuerde que este campo es de 0 a 8');
            $("#puntaje_trabajo_colaborativoINNinv").val('');
        }
        var puntaje_claridad_pregunta = Number($("input[id='puntaje_claridad_preguntaINNinv']").val());
        if (puntaje_claridad_pregunta > 8 || puntaje_claridad_pregunta < 0) {
            alert('Recuerde que este campo es de 0 a 8');
            $("#puntaje_claridad_preguntaINNinv").val('');
        }

        //RUTA_INDAGACION
        var puntaje_diseño_metodologico = Number($("input[id='puntaje_diseño_metodologicoINNinv']").val());
        if (puntaje_diseño_metodologico > 10 || puntaje_diseño_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 10');
            $("#puntaje_diseño_metodologicoINNinv").val('');
        }
        var puntaje_conceptos_investigacion = Number($("input[id='puntaje_conceptos_investigacionINNinv']").val());
        if (puntaje_conceptos_investigacion > 10 || puntaje_conceptos_investigacion < 0) {
            alert('Recuerde que este campo es de 0 a 10');
            $("#puntaje_conceptos_investigacionINNinv").val('');
        }
        var puntaje_resultados_claros = Number($("input[id='puntaje_resultados_clarosINNinv']").val());
        if (puntaje_resultados_claros > 10 || puntaje_resultados_claros < 0) {
            alert('Recuerde que este campo es de 0 a 10');
            $("#puntaje_resultados_clarosINNinv").val('');
        }

        //FUENTES
        var puntaje_forma_adecuada = Number($("input[id='puntaje_forma_adecuadaINNinv']").val());
        if (puntaje_forma_adecuada > 4 || puntaje_forma_adecuada < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_forma_adecuadaINNinv").val('');
        }

    });
});


function borra() {
    var aItems = document.getElementsByName("lineas_open");
    for (var i = 0; i < aItems.length; i++) {
        aItems[i].checked = false;
    }

} 