$(document).ready(function(){

    $( "#dialog" ).dialog({
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
        var fechaAperturaSelect=new Date($('#fecha_apertura').val());
        fechaAperturaSelect.setDate(fechaAperturaSelect.getDate()+1);
        var fechaCierreSelect=new Date($('#fecha_cierre').val());
        fechaCierreSelect.setDate(fechaCierreSelect.getDate()+1);
        var fechaResultadosSelect=new Date($('#fecha_resultados').val());
        fechaResultadosSelect.setDate(fechaResultadosSelect.getDate()+1);
        
        if(fechaActual>fechaAperturaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de apertura de la convocatoria debe ser mayor o igual a la fecha actual");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaCierreSelect<fechaAperturaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de cierre de la convocatoria debe ser mayor o igual a su fecha de apertura");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaResultadosSelect<fechaCierreSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de publicación de resultados de la convocatoria debe ser mayor o igual a su fecha de cierre");
            $( "#dialog" ).dialog("open");
            return false;
        }
        return true;
    });
    
    $('#guardar').click(function(){
        var fechaAperturaSelect=new Date($('#fecha_apertura').val());
        fechaAperturaSelect.setDate(fechaAperturaSelect.getDate()+1);
        var fechaCierreSelect=new Date($('#fecha_cierre').val());
        fechaCierreSelect.setDate(fechaCierreSelect.getDate()+1);
        var fechaResultadosSelect=new Date($('#fecha_resultados').val());
        fechaResultadosSelect.setDate(fechaResultadosSelect.getDate()+1);
        
        if(fechaCierreSelect<fechaAperturaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de cierre de la convocatoria debe ser mayor o igual a su fecha de apertura");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaResultadosSelect<fechaCierreSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de publicación de resultados de la convocatoria debe ser mayor o igual a su fecha de cierre");
            $( "#dialog" ).dialog("open");
            return false;
        }
        return true;
    });
    
});
