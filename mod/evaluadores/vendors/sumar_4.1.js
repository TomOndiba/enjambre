$(document).ready(function() {
    $("input[type='number']").live('change',(function() {
        var sumaTotal = 0;
        var sumaCoherencia = 0;
        var sumaRuta = 0;
        var sumaFuentes = 0;
        //COHERENCIA
        sumaCoherencia = Number($("input[id='puntaje_trabajo_colaborativo']").val());
        sumaCoherencia += Number($("input[id='puntaje_relacion_pregunta']").val());
        $("#subtotal_coherencia").val(sumaCoherencia);

        //RUTA_INDAGACION
        sumaRuta = Number($("input[id='puntaje_diseño_metodologico']").val());
        sumaRuta += Number($("input[id='puntaje_conocimientos_conceptos']").val());
        sumaRuta += Number($("input[id='puntaje_resultados_claros']").val());
        $("#subtotal_ruta").val(sumaRuta);

        //FUENTES
        sumaFuentes = Number($("input[id='puntaje_forma_adecuada']").val());
        $("#subtotal_fuentes").val(sumaFuentes);


        sumaTotal = sumaCoherencia + sumaRuta + sumaFuentes;
        
        $("#puntaje_total41").val(sumaTotal);
    }));

    $("input[type='number']").live('keyup',(function() {
        var sumaTotal = 0;
        var sumaCoherencia = 0;
        var sumaRuta = 0;
        var sumaFuentes = 0;
        //COHERENCIA
        sumaCoherencia = Number($("input[id='puntaje_trabajo_colaborativo']").val());
        sumaCoherencia += Number($("input[id='puntaje_relacion_pregunta']").val());
        $("#subtotal_coherencia").val(sumaCoherencia);

        //RUTA_INDAGACION
        sumaRuta = Number($("input[id='puntaje_diseño_metodologico']").val());
        sumaRuta += Number($("input[id='puntaje_conocimientos_conceptos']").val());
        sumaRuta += Number($("input[id='puntaje_resultados_claros']").val());
        $("#subtotal_ruta").val(sumaRuta);

        //FUENTES
        sumaFuentes = Number($("input[id='puntaje_forma_adecuada']").val());
        $("#subtotal_fuentes").val(sumaFuentes);


        sumaTotal = sumaCoherencia + sumaRuta + sumaFuentes;
          
        $("#puntaje_total41").val(sumaTotal);
    }));

    $("input[type='number']").live('change',(function() {

        //COHERENCIA
        var puntaje_trabajo_colaborativo = Number($("input[id='puntaje_trabajo_colaborativo']").val());
        if (puntaje_trabajo_colaborativo > 1.5 || puntaje_trabajo_colaborativo < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_trabajo_colaborativo").val('');
        }
        var puntaje_relacion_pregunta = Number($("input[id='puntaje_relacion_pregunta']").val());
        if (puntaje_relacion_pregunta > 1.5 || puntaje_relacion_pregunta < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_relacion_pregunta").val('');
        }

        //RUTA_INDAGACION
        var puntaje_diseño_metodologico = Number($("input[id='puntaje_diseño_metodologico']").val());
        if (puntaje_diseño_metodologico > 2 || puntaje_diseño_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_diseño_metodologico").val('');
        }
        var puntaje_conocimientos_conceptos = Number($("input[id='puntaje_conocimientos_conceptos']").val());
        if (puntaje_conocimientos_conceptos > 1.5 || puntaje_conocimientos_conceptos < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_conocimientos_conceptos").val('');
        }
        var puntaje_resultados_claros = Number($("input[id='puntaje_resultados_claros']").val());
        if (puntaje_resultados_claros > 1.5 || puntaje_resultados_claros < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_resultados_claros").val('');
        }

        //FUENTES
        var puntaje_forma_adecuada = Number($("input[id='puntaje_forma_adecuada']").val());
        if (puntaje_forma_adecuada > 2 || puntaje_forma_adecuada < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_forma_adecuada").val('');
        }
    }));
    $("input[type='number']").live('keyup',(function() {
        //COHERENCIA
        var puntaje_trabajo_colaborativo = Number($("input[id='puntaje_trabajo_colaborativo']").val());
        if (puntaje_trabajo_colaborativo > 1.5 || puntaje_trabajo_colaborativo < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_trabajo_colaborativo").val('');
        }
        var puntaje_relacion_pregunta = Number($("input[id='puntaje_relacion_pregunta']").val());
        if (puntaje_relacion_pregunta > 1.5 || puntaje_relacion_pregunta < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_relacion_pregunta").val('');
        }

        //RUTA_INDAGACION
        var puntaje_diseño_metodologico = Number($("input[id='puntaje_diseño_metodologico']").val());
        if (puntaje_diseño_metodologico > 2 || puntaje_diseño_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_diseño_metodologico").val('');
        }
        var puntaje_conocimientos_conceptos = Number($("input[id='puntaje_conocimientos_conceptos']").val());
        if (puntaje_conocimientos_conceptos > 1.5 || puntaje_conocimientos_conceptos < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_conocimientos_conceptos").val('');
        }
        var puntaje_resultados_claros = Number($("input[id='puntaje_resultados_claros']").val());
        if (puntaje_resultados_claros > 1.5 || puntaje_resultados_claros < 0) {
            alert('Recuerde que este campo es de 0 a 1.5');
            $("#puntaje_resultados_claros").val('');
        }

        //FUENTES
        var puntaje_forma_adecuada = Number($("input[id='puntaje_forma_adecuada']").val());
        if (puntaje_forma_adecuada > 2 || puntaje_forma_adecuada < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_forma_adecuada").val('');
        }

    }));
});


