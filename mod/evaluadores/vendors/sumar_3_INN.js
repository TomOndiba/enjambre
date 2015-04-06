$(document).ready(function() {
    $("input[type='number']").live('change',(function() {
        
        var sumaTotal = 0;
        var sumaApropiacion = 0;
        var sumaCapacidades = 0;
        var sumaPUESTO = 0;
        //Apropiacion
        sumaApropiacion = Number($("input[id='puntaje_presenta_claridad']").val());
        sumaApropiacion += Number($("input[id='puntaje_explica_fundamentos']").val());
        sumaApropiacion += Number($("input[id='puntaje_proceso_metodologico']").val());
        sumaApropiacion += Number($("input[id='puntaje_innovacion_lograda']").val());
        $("#subtotal_apropiacion").val(sumaApropiacion);

        //Capacidades
        sumaCapacidades = Number($("input[id='puntaje_evidentes_capacidades']").val());
        $("#subtotal_capacidades").val(sumaCapacidades);

        //PUESTO
        sumaPUESTO = Number($("input[id='puntaje_diseño_investigativo']").val());
        $("#subtotal_puesto").val(sumaPUESTO);

        sumaTotal = sumaApropiacion + sumaCapacidades + sumaPUESTO;

        $("#puntaje_total").val(sumaTotal);
    }));

    $("input[type='number']").live('keyup',(function() {
        
        var sumaTotal = 0;
        var sumaApropiacion = 0;
        var sumaCapacidades = 0;
        var sumaPUESTO = 0;
        //Apropiacion
        sumaApropiacion = Number($("input[id='puntaje_presenta_claridad']").val());
        sumaApropiacion += Number($("input[id='puntaje_explica_fundamentos']").val());
        sumaApropiacion += Number($("input[id='puntaje_proceso_metodologico']").val());
        sumaApropiacion += Number($("input[id='puntaje_innovacion_lograda']").val());
        $("#subtotal_apropiacion").val(sumaApropiacion);

        //Capacidades
        sumaCapacidades = Number($("input[id='puntaje_evidentes_capacidades']").val());
        $("#subtotal_capacidades").val(sumaCapacidades);

        //PUESTO
        sumaPUESTO = Number($("input[id='puntaje_diseño_investigativo']").val());
        $("#subtotal_puesto").val(sumaPUESTO);

        sumaTotal = sumaApropiacion + sumaCapacidades + sumaPUESTO;

        $("#puntaje_total").val(sumaTotal);
    }));

    $("input[type='number']").live('change',(function() {

        //Apropiacion
        var puntaje_presenta_claridad = Number($("input[id='puntaje_presenta_claridad']").val());
        if (puntaje_presenta_claridad > 3 || puntaje_presenta_claridad < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_presenta_claridad").val('');
        }
        var puntaje_explica_fundamentos = Number($("input[id='puntaje_explica_fundamentos']").val());
        if (puntaje_explica_fundamentos > 3 || puntaje_explica_fundamentos < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_explica_fundamentos").val('');
        }
        var puntaje_proceso_metodologico = Number($("input[id='puntaje_proceso_metodologico']").val());
        if (puntaje_proceso_metodologico > 3 || puntaje_proceso_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_proceso_metodologico").val('');
        }
        var puntaje_innovacion_lograda = Number($("input[id='puntaje_innovacion_lograda']").val());
        if (puntaje_innovacion_lograda > 3 || puntaje_innovacion_lograda < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_innovacion_lograda").val('');
        }

        //Capacidades
        var puntaje_evidentes_capacidades = Number($("input[id='puntaje_evidentes_capacidades']").val());
        if (puntaje_evidentes_capacidades > 6 || puntaje_evidentes_capacidades < 0) {
            alert('Recuerde que este campo es de 0 a 6');
            $("#puntaje_evidentes_capacidades").val('');
        }

        //PUESTO
        var puntaje_diseño_investigativo = Number($("input[id='puntaje_diseño_investigativo']").val());
        if (puntaje_diseño_investigativo > 3 || puntaje_diseño_investigativo < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_diseño_investigativo").val('');
        }
    }));
    $("input[type='number']").live('keyup',(function() {
        //Apropiacion
        
        var puntaje_presenta_claridad = Number($("input[id='puntaje_presenta_claridad']").val());
        if (puntaje_presenta_claridad > 3 || puntaje_presenta_claridad < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_presenta_claridad").val('');
        }
        var puntaje_explica_fundamentos = Number($("input[id='puntaje_explica_fundamentos']").val());
        if (puntaje_explica_fundamentos > 3 || puntaje_explica_fundamentos < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_explica_fundamentos").val('');
        }
        var puntaje_proceso_metodologico = Number($("input[id='puntaje_proceso_metodologico']").val());
        if (puntaje_proceso_metodologico > 3 || puntaje_proceso_metodologico < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_proceso_metodologico").val('');
        }
        var puntaje_innovacion_lograda = Number($("input[id='puntaje_innovacion_lograda']").val());
        if (puntaje_innovacion_lograda > 3 || puntaje_innovacion_lograda < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_innovacion_lograda").val('');
        }

        //Capacidades
        var puntaje_evidentes_capacidades = Number($("input[id='puntaje_evidentes_capacidades']").val());
        if (puntaje_evidentes_capacidades > 6 || puntaje_evidentes_capacidades < 0) {
            alert('Recuerde que este campo es de 0 a 6');
            $("#puntaje_evidentes_capacidades").val('');
        }

        //PUESTO
        var puntaje_diseño_investigativo = Number($("input[id='puntaje_diseño_investigativo']").val());
        if (puntaje_diseño_investigativo > 3 || puntaje_diseño_investigativo < 0) {
            alert('Recuerde que este campo es de 0 a 2');
            $("#puntaje_diseño_investigativo").val('');
        }

    }));
});




