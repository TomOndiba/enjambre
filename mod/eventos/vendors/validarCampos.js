$(document).ready(function(){
    
    $("#asistentes").live('keyup',function() 
    { 
        
        if(event.keyCode!==8 &&event.keyCode!==20 &&event.keyCode!==17 &&event.keyCode!==46 && event.keyCode!==40 &&event.keyCode!==35 &&event.keyCode!==13 &&event.keyCode!==27 &&  event.keyCode!==36 
                &&event.keyCode!==45 &&event.keyCode!==37 &&event.keyCode!==34 &&event.keyCode!==33 &&event.keyCode!==39 &&event.keyCode!==16 &&event.keyCode!==32 && event.keyCode!==9 &&event.keyCode!==38){     
            
            Numer=parseInt($('#asistentes').val());
          
            if (isNaN(Numer)){
                $(this).val("");
            }else{
                $(this).val(Numer);
            }
        }
    }); 
    
      $("#input1").live('keyup',function() 
    { 
        
        if(event.keyCode!==8 &&event.keyCode!==20 &&event.keyCode!==17 &&event.keyCode!==46 && event.keyCode!==40 &&event.keyCode!==35 &&event.keyCode!==13 &&event.keyCode!==27 &&  event.keyCode!==36 
                &&event.keyCode!==45 &&event.keyCode!==37 &&event.keyCode!==34 &&event.keyCode!==33 &&event.keyCode!==39 &&event.keyCode!==16 &&event.keyCode!==32 && event.keyCode!==9 &&event.keyCode!==38){     
            
            Numer=parseInt($('#input1').val());
            
            if (isNaN(Numer)){
                $(this).val("");
            }else{
                $(this).val(Numer);
            }
        }
    }); 
    
      $("#input2").live('keyup',function() 
    { 
        
        if(event.keyCode!==8 &&event.keyCode!==20 &&event.keyCode!==17 &&event.keyCode!==46 && event.keyCode!==40 &&event.keyCode!==35 &&event.keyCode!==13 &&event.keyCode!==27 &&  event.keyCode!==36 
                &&event.keyCode!==45 &&event.keyCode!==37 &&event.keyCode!==34 &&event.keyCode!==33 &&event.keyCode!==39 &&event.keyCode!==16 &&event.keyCode!==32 && event.keyCode!==9 &&event.keyCode!==38){     
            
            Numer=parseInt($('#input2').val());
            
            if (isNaN(Numer)){
                $(this).val("");
            }else{
                $(this).val(Numer);
            }
        }
    }); 
    
    $("#input3").live('keyup',function() 
    { 
        if(event.keyCode!==8 &&event.keyCode!==20 &&event.keyCode!==17 &&event.keyCode!==46 && event.keyCode!==40 &&event.keyCode!==35 &&event.keyCode!==13 &&event.keyCode!==27 &&  event.keyCode!==36 
                &&event.keyCode!==45 &&event.keyCode!==37 &&event.keyCode!==34 &&event.keyCode!==33 &&event.keyCode!==39 &&event.keyCode!==16 &&event.keyCode!==32 && event.keyCode!==9 &&event.keyCode!==38){     
            
            Numer=parseInt($('#input3').val());
            
            if (isNaN(Numer)){
                $(this).val("");
            }else{
                $(this).val(Numer);
            }
        }
    });
    
    
    $( "#dialogo" ).dialog({
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
    
    
    $('#aceptar').click(function(){
        var fechaActual=new Date();
        var fechaIniSelect=new Date($('#fecha_ini').val());
        fechaIniSelect.setDate(fechaIniSelect.getDate()+1);
        var fechaFinSelect=new Date($('#fecha_fin').val());
        fechaFinSelect.setDate(fechaFinSelect.getDate()+1);
        var fechaConfirmSelect=new Date($('#fecha_confirm').val());
        fechaConfirmSelect.setDate(fechaConfirmSelect.getDate()+1);
        
        if(fechaActual>fechaIniSelect){
            $( "#dialogo" ).html("");
            $( "#dialogo" ).append("La fecha de inicio del evento debe ser mayor o igual a la fecha actual");
            $( "#dialogo" ).dialog("open");
            return false;
        }else if(fechaFinSelect<fechaIniSelect){
            $( "#dialogo" ).html("");
            $( "#dialogo" ).append("La fecha de terminación del evento debe ser mayor o igual a su fecha de inicio");
            $( "#dialogo" ).dialog("open");
            return false;
        }else if(fechaConfirmSelect>fechaIniSelect || fechaConfirmSelect<fechaActual){
            $( "#dialogo" ).html("");
            $( "#dialogo" ).append("La fecha límite de confirmación del evento debe ser menor o igual a su fecha de inicio, y mayor a la fecha actual");
            $( "#dialogo" ).dialog("open");
            return false;
        }
        return true;
    });
    
});
