

$(document).ready(function(){
    
    
    $( "#dialog_ev" ).dialog({
        autoOpen: false, // no abrir automáticamente
        resizable: true, //permite cambiar el tamaño
        height:220, // altura
        modal: true, //capa principal, fondo opaco
        buttons: { //crear botón de cerrar
            "Cerrar": function() {
                $( this ).dialog( "close" );
            }
        }
    });
    
    
    $('#aceptarEvento').live('click',function(){
        var fechaActual=new Date();
        var fechaInicioEvento=new Date($('#fechaInicio').val());
        fechaInicioEvento.setDate(fechaInicioEvento.getDate()+1);
        var fechaFinEvento=new Date($('#fechaFin').val());
        fechaFinEvento.setDate(fechaFinEvento.getDate()+1);
        
      
        if(fechaActual>=fechaInicioEvento){
            $( "#dialog_ev" ).html("");
            $( "#dialog_ev" ).append("La fecha de inicio del Evento debe ser mayor o igual a la fecha actual");
            $( "#dialog_ev" ).dialog("open");
            return false;
        }
        else if(fechaActual>=fechaFinEvento){
            $( "#dialog_ev" ).html("");
            $( "#dialog_ev" ).append("La fecha de fin del Evento debe ser mayor o igual a la fecha actual");
            $( "#dialog_ev" ).dialog("open");
            return false;
        }
        else if(fechaInicioEvento>fechaFinEvento){
            $( "#dialog_ev" ).html("");
            $( "#dialog_ev" ).append("La fecha de inicio del Evento debe ser menor o igual a la fecha de Fin");
            $( "#dialog_ev" ).dialog("open");
            return false;
        }
         return true;
        
    });
    
       
        
    
});