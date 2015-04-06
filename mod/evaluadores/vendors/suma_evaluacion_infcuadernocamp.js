$(document).ready(function() {
    $("input[type='number']").live('change',(function() {
        var sumaTipoDCINN = 0;
        var sumaFundamentacionDCINN = 0;
        var sumaImpactoDCINN = 0;
        var sumaApropiacionDCINN = 0;
        var sumaTotalDCINN = 0;
        sumaFundamentacionDCINN = Number($("input[id='puntaje_fundamentos_conocimientoDCINN']").val());
        sumaFundamentacionDCINN += Number($("input[id='puntaje_propuesta_metodologicaDCINN']").val());
        sumaFundamentacionDCINN+= Number($("input[id='puntaje_existe_coherenciaDCINN']").val());
        $("#subtotal_fundamentacionDCINN").val(sumaFundamentacionDCINN);
        
        sumaTipoDCINN = Number($("input[id='puntaje_forma_originalDCINN']").val());
        sumaTipoDCINN += Number($("input[id='puntaje_argumenta_transformacionDCINN']").val());
        sumaTipoDCINN += Number($("input[id='puntaje_proceso_investigativoDCINN']").val());
        $("#subtotal_tiposDCINN").val(sumaTipoDCINN);
        
        sumaImpactoDCINN = Number($("input[id='puntaje_grado_elaboracionDCINN']").val());
        sumaImpactoDCINN += Number($("input[id='puntaje_resultados_investigacionDCINN']").val());
        sumaImpactoDCINN += Number($("input[id='puntaje_evolucion_desarrolloDCINN']").val());
        $("#subtotal_impactoDCINN").val(sumaImpactoDCINN);
                
        sumaApropiacionDCINN = Number($("input[id='puntaje_forma_originalDCINN']").val());
        sumaApropiacionDCINN += Number($("input[id='puntaje_social_logradoDCINN']").val());
        sumaApropiacionDCINN += Number($("input[id='puntaje_importancia_socialDCINN']").val());
        $("#subtotal_apropiacionDCINN").val(sumaApropiacionDCINN);
        
        sumaTotalDCINN = sumaFundamentacionDCINN + sumaTipoDCINN + sumaImpactoDCINN + sumaApropiacionDCINN;
        
        $("#puntaje_totalDCINN").val(sumaTotalDCINN);
    }));
    
    $("input[type='number']").live('keyup',(function() {
           var sumaTipoDCINN = 0;
        var sumaFundamentacionDCINN = 0;
        var sumaImpactoDCINN = 0;
        var sumaApropiacionDCINN = 0;
        var sumaTotalDCINN = 0;
        sumaFundamentacionDCINN = Number($("input[id='puntaje_fundamentos_conocimientoDCINN']").val());
        sumaFundamentacionDCINN += Number($("input[id='puntaje_propuesta_metodologicaDCINN']").val());
        sumaFundamentacionDCINN+= Number($("input[id='puntaje_existe_coherenciaDCINN']").val());
        $("#subtotal_fundamentacionDCINN").val(sumaFundamentacionDCINN);
        
        sumaTipoDCINN = Number($("input[id='puntaje_forma_originalDCINN']").val());
        sumaTipoDCINN += Number($("input[id='puntaje_argumenta_transformacionDCINN']").val());
        sumaTipoDCINN += Number($("input[id='puntaje_proceso_investigativoDCINN']").val());
        $("#subtotal_tiposDCINN").val(sumaTipoDCINN);
        
        sumaImpactoDCINN = Number($("input[id='puntaje_grado_elaboracionDCINN']").val());
        sumaImpactoDCINN += Number($("input[id='puntaje_resultados_investigacionDCINN']").val());
        sumaImpactoDCINN += Number($("input[id='puntaje_evolucion_desarrolloDCINN']").val());
        $("#subtotal_impactoDCINN").val(sumaImpactoDCINN);
                
        sumaApropiacionDCINN = Number($("input[id='puntaje_forma_originalDCINN']").val());
        sumaApropiacionDCINN += Number($("input[id='puntaje_social_logradoDCINN']").val());
        sumaApropiacionDCINN += Number($("input[id='puntaje_importancia_socialDCINN']").val());
        $("#subtotal_apropiacionDCINN").val(sumaApropiacionDCINN);
        
        sumaTotalDCINN = sumaFundamentacionDCINN + sumaTipoDCINN + sumaImpactoDCINN + sumaApropiacionDCINN;
        
        $("#puntaje_totalDCINN").val(sumaTotalDCINN);
    }));

    $("input[type='number']").live('change',(function() {

            //FUNDAMENTACION
        var puntaje_fundamentos_conocimiento = Number($("input[id='puntaje_fundamentos_conocimientoDCINN']").val());
        if (puntaje_fundamentos_conocimiento > 6 || puntaje_fundamentos_conocimiento < 0) {
            alert('Recuerde que este campo es de 0 a 6');
            $("#puntaje_fundamentos_conocimientoDCINN").val('');
        }
        var puntaje_propuesta_metodologica = Number($("input[id='puntaje_propuesta_metodologicaDCINN']").val());
        if (puntaje_propuesta_metodologica > 5 || puntaje_propuesta_metodologica < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_propuesta_metodologicaDCINN").val('');
        }        
        var puntaje_existe_coherencia = Number($("input[id='puntaje_existe_coherenciaDCINN']").val());
        if (puntaje_existe_coherencia > 5 || puntaje_existe_coherencia < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_existe_coherenciaDCINN").val('');
        }
        
            //TIPOS Y PROCESOS
        var puntaje_forma_original = Number($("input[id='puntaje_forma_originalDCINN']").val());
        if (puntaje_forma_original > 4 || puntaje_forma_original < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_forma_originalDCINN").val('');
        }
        var puntaje_argumenta_transformacion = Number($("input[id='puntaje_argumenta_transformacionDCINN']").val());
        if (puntaje_argumenta_transformacion > 4 || puntaje_argumenta_transformacion < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_argumenta_transformacionDCINN").val('');
        }
        var puntaje_proceso_investigativo = Number($("input[id='puntaje_proceso_investigativoDCINN']").val());
        if (puntaje_proceso_investigativo > 4 || puntaje_proceso_investigativo < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_proceso_investigativoDCINN").val('');
        }
        
            //Pertinencia
        var puntaje_grado_elaboracion = Number($("input[id='puntaje_grado_elaboracionDCINN']").val());
        if (puntaje_grado_elaboracion > 4 || puntaje_grado_elaboracion < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_grado_elaboracionDCINN").val('');
        }
        var puntaje_resultados_investigacion = Number($("input[id='puntaje_resultados_investigacionDCINN']").val());
        if (puntaje_resultados_investigacion > 4 || puntaje_resultados_investigacion < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_resultados_investigacionDCINN").val('');
        }
        var puntaje_evolucion_desarrollo = Number($("input[id='puntaje_evolucion_desarrolloDCINN']").val());
        if (puntaje_evolucion_desarrollo > 4 || puntaje_evolucion_desarrollo < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_evolucion_desarrolloDCINN").val('');
        }
            
            //Apropiacion
        var puntaje_dinamica_vivida = Number($("input[id='puntaje_dinamica_vividaDCINN']").val());
        if (puntaje_dinamica_vivida > 4 || puntaje_dinamica_vivida < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_dinamica_vividaDCINN").val('');
        }
        var puntaje_social_logrado = Number($("input[id='puntaje_social_logradoDCINN']").val());
        if (puntaje_social_logrado > 3 || puntaje_social_logrado < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_social_logradoDCINN").val('');
        }
        var puntaje_importancia_social = Number($("input[id='puntaje_importancia_socialDCINN']").val());
        if (puntaje_importancia_social > 3 || puntaje_importancia_social < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_importancia_socialDCINN").val('');
        }
    }));
    $("input[type='number']").live('keyup',(function() {
            
              //FUNDAMENTACION
        var puntaje_fundamentos_conocimiento = Number($("input[id='puntaje_fundamentos_conocimientoDCINN']").val());
        if (puntaje_fundamentos_conocimiento > 6 || puntaje_fundamentos_conocimiento < 0) {
            alert('Recuerde que este campo es de 0 a 6');
            $("#puntaje_fundamentos_conocimientoDCINN").val('');
        }
        var puntaje_propuesta_metodologica = Number($("input[id='puntaje_propuesta_metodologicaDCINN']").val());
        if (puntaje_propuesta_metodologica > 5 || puntaje_propuesta_metodologica < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_propuesta_metodologicaDCINN").val('');
        }        
        var puntaje_existe_coherencia = Number($("input[id='puntaje_existe_coherenciaDCINN']").val());
        if (puntaje_existe_coherencia > 5 || puntaje_existe_coherencia < 0) {
            alert('Recuerde que este campo es de 0 a 5');
            $("#puntaje_existe_coherenciaDCINN").val('');
        }
        
            //TIPOS Y PROCESOS
        var puntaje_forma_original = Number($("input[id='puntaje_forma_originalDCINN']").val());
        if (puntaje_forma_original > 4 || puntaje_forma_original < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_forma_originalDCINN").val('');
        }
        var puntaje_argumenta_transformacion = Number($("input[id='puntaje_argumenta_transformacionDCINN']").val());
        if (puntaje_argumenta_transformacion > 4 || puntaje_argumenta_transformacion < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_argumenta_transformacionDCINN").val('');
        }
        var puntaje_proceso_investigativo = Number($("input[id='puntaje_proceso_investigativoDCINN']").val());
        if (puntaje_proceso_investigativo > 4 || puntaje_proceso_investigativo < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_proceso_investigativoDCINN").val('');
        }
        
            //Pertinencia
        var puntaje_grado_elaboracion = Number($("input[id='puntaje_grado_elaboracionDCINN']").val());
        if (puntaje_grado_elaboracion > 4 || puntaje_grado_elaboracion < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_grado_elaboracionDCINN").val('');
        }
        var puntaje_resultados_investigacion = Number($("input[id='puntaje_resultados_investigacionDCINN']").val());
        if (puntaje_resultados_investigacion > 4 || puntaje_resultados_investigacion < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_resultados_investigacionDCINN").val('');
        }
        var puntaje_evolucion_desarrollo = Number($("input[id='puntaje_evolucion_desarrolloDCINN']").val());
        if (puntaje_evolucion_desarrollo > 4 || puntaje_evolucion_desarrollo < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_evolucion_desarrolloDCINN").val('');
        }
            
            //Apropiacion
        var puntaje_dinamica_vivida = Number($("input[id='puntaje_dinamica_vividaDCINN']").val());
        if (puntaje_dinamica_vivida > 4 || puntaje_dinamica_vivida < 0) {
            alert('Recuerde que este campo es de 0 a 4');
            $("#puntaje_dinamica_vividaDCINN").val('');
        }
        var puntaje_social_logrado = Number($("input[id='puntaje_social_logradoDCINN']").val());
        if (puntaje_social_logrado > 3 || puntaje_social_logrado < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_social_logradoDCINN").val('');
        }
        var puntaje_importancia_social = Number($("input[id='puntaje_importancia_socialDCINN']").val());
        if (puntaje_importancia_social > 3 || puntaje_importancia_social < 0) {
            alert('Recuerde que este campo es de 0 a 3');
            $("#puntaje_importancia_socialDCINN").val('');
        }
    }));
});


