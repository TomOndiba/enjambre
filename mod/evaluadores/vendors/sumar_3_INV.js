$(document).ready(function() {
    $("input[type='number']").live('change',(function() {
        var sumaTotalINV = 0;
        var sumaApropiacionINV = 0;
        var sumaCapacidadesINV = 0;
        var sumaPUESTOINV = 0;
        
        //Apropiacion
        sumaApropiacionINV = Number($("input[id='puntaje_presenta_claridadINV']").val());
        sumaApropiacionINV += Number($("input[id='puntaje_explica_fundamentosINV']").val());
        sumaApropiacionINV += Number($("input[id='puntaje_proceso_metodologicoINV']").val());
        sumaApropiacionINV += Number($("input[id='puntaje_innovacion_logradaINV']").val());
        $("#subtotal_apropiacionINV").val(sumaApropiacionINV);

        //Capacidades
        sumaCapacidadesINV = Number($("input[id='puntaje_evidentes_capacidadesINV']").val());
        $("#subtotal_capacidadesINV").val(sumaCapacidadesINV);

        //PUESTO
        sumaPUESTOINV = Number($("input[id='puntaje_diseño_investigativoINV']").val());
        $("#subtotal_puestoINV").val(sumaPUESTOINV);

        sumaTotalINV = sumaApropiacionINV + sumaCapacidadesINV + sumaPUESTOINV;

        $("#puntaje_totalINV").val(sumaTotalINV);
    }));

    $("input[type='number']").live('keyup',(function() {
        var sumaTotalINV = 0;
        var sumaApropiacionINV = 0;
        var sumaCapacidadesINV = 0;
        var sumaPUESTOINV = 0;
        //Apropiacion
        sumaApropiacionINV = Number($("input[id='puntaje_presenta_claridadINV']").val());
        sumaApropiacionINV += Number($("input[id='puntaje_explica_fundamentosINV']").val());
        sumaApropiacionINV += Number($("input[id='puntaje_proceso_metodologicoINV']").val());
        sumaApropiacionINV += Number($("input[id='puntaje_innovacion_logradaINV']").val());
        $("#subtotal_apropiacionINV").val(sumaApropiacionINV);

        //Capacidades
        sumaCapacidadesINV = Number($("input[id='puntaje_evidentes_capacidadesINV']").val());
        $("#subtotal_capacidadesINV").val(sumaCapacidadesINV);

        //PUESTO
        sumaPUESTOINV = Number($("input[id='puntaje_diseño_investigativoINV']").val());
        $("#subtotal_puestoINV").val(sumaPUESTOINV);

        sumaTotalINV = sumaApropiacionINV + sumaCapacidadesINV + sumaPUESTOINV;

        $("#puntaje_totalINV").val(sumaTotalINV);
    }));

    $("input[type='number']").live('change',(function() {

        //Apropiacion
        var puntaje_presenta_claridad = Number($("input[id='puntaje_presenta_claridadINV']").val());
        if (puntaje_presenta_claridad > 5 || puntaje_presenta_claridad < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_presenta_claridadINV").val('');
        }
        var puntaje_explica_fundamentos = Number($("input[id='puntaje_explica_fundamentosINV']").val());
        if (puntaje_explica_fundamentos > 5 || puntaje_explica_fundamentos < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_explica_fundamentosINV").val('');
        }
        var puntaje_proceso_metodologico = Number($("input[id='puntaje_proceso_metodologicoINV']").val());
        if (puntaje_proceso_metodologico > 5 || puntaje_proceso_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_proceso_metodologicoINV").val('');
        }
        var puntaje_innovacion_lograda = Number($("input[id='puntaje_innovacion_logradaINV']").val());
        if (puntaje_innovacion_lograda > 5 || puntaje_innovacion_lograda < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_innovacion_logradaINV").val('');
        }

        //Capacidades
        var puntaje_evidentes_capacidades = Number($("input[id='puntaje_evidentes_capacidadesINV']").val());
        if (puntaje_evidentes_capacidades > 6 || puntaje_evidentes_capacidades < 0) {
            alert('Recuerde que este campo es de 0 a 6');
            $("#puntaje_evidentes_capacidadesINV").val('');
        }

        //PUESTO
        var puntaje_diseño_investigativo = Number($("input[id='puntaje_diseño_investigativoINV']").val());
        if (puntaje_diseño_investigativo > 4 || puntaje_diseño_investigativo < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_diseño_investigativoINV").val('');
        }
    }));
    $("input[type='number']").live('keyup',(function() {
        //Apropiacion
        var puntaje_presenta_claridad = Number($("input[id='puntaje_presenta_claridadINV']").val());
        if (puntaje_presenta_claridad > 5 || puntaje_presenta_claridad < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_presenta_claridadINV").val('');
        }
        var puntaje_explica_fundamentos = Number($("input[id='puntaje_explica_fundamentosINV']").val());
        if (puntaje_explica_fundamentos > 5 || puntaje_explica_fundamentos < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_explica_fundamentosINV").val('');
        }
        var puntaje_proceso_metodologico = Number($("input[id='puntaje_proceso_metodologicoINV']").val());
        if (puntaje_proceso_metodologico > 5 || puntaje_proceso_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_proceso_metodologicoINV").val('');
        }
        var puntaje_innovacion_lograda = Number($("input[id='puntaje_innovacion_logradaINV']").val());
        if (puntaje_innovacion_lograda > 5 || puntaje_innovacion_lograda < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_innovacion_logradaINV").val('');
        }

        //Capacidades
        var puntaje_evidentes_capacidades = Number($("input[id='puntaje_evidentes_capacidadesINV']").val());
        if (puntaje_evidentes_capacidades > 6 || puntaje_evidentes_capacidades < 0) {
            alert('Recuerde que este campo es de 0 a 6');
            $("#puntaje_evidentes_capacidadesINV").val('');
        }

        //PUESTO
        var puntaje_diseño_investigativo = Number($("input[id='puntaje_diseño_investigativoINV']").val());
        if (puntaje_diseño_investigativo > 4 || puntaje_diseño_investigativo < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_diseño_investigativoINV").val('');
        }

    }));
});



