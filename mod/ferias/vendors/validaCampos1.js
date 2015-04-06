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
        var fechaIniFeriaSelect=new Date($('#fecha_inicio_feria').val());
        fechaIniFeriaSelect.setDate(fechaIniFeriaSelect.getDate()+1);
        var fechaFinFeriaSelect=new Date($('#fecha_fin_feria').val());
        fechaFinFeriaSelect.setDate(fechaFinFeriaSelect.getDate()+1);
        
        var fechaIniInscripcionSelect=new Date($('#fecha_inicio_inscripciones').val());
        fechaIniInscripcionSelect.setDate(fechaIniInscripcionSelect.getDate()+1);
        var fechaFinInscripcionSelect=new Date($('#fecha_fin_inscripciones').val());
        fechaFinInscripcionSelect.setDate(fechaFinInscripcionSelect.getDate()+1);
        
        var fechaMontajeSelect=new Date($('#fecha_montaje').val());
        fechaMontajeSelect.setDate(fechaMontajeSelect.getDate()+1);
        var fechaDesmontajeSelect=new Date($('#fecha_desmontaje').val());
        fechaDesmontajeSelect.setDate(fechaDesmontajeSelect.getDate()+1);
        
        if(fechaActual>=fechaIniInscripcionSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de inicio de inscripciones debe ser mayor o igual a la fecha actual");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaIniInscripcionSelect>fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de inicio de inscripciones debe ser menor a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaFinInscripcionSelect>=fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de fin de inscripciones debe ser menor o igual a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaIniInscripcionSelect>fechaFinInscripcionSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de inicio de inscripciones debe ser menor a la fecha de fin de las mismas");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaFinFeriaSelect<=fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de fin de la feria debe ser mayor o igual a su fecha de inicio");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaMontajeSelect>fechaDesmontajeSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de montaje de puestos debe ser menor a la fecha de desmontaje");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaMontajeSelect>=fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de montaje de puestos debe ser menor o igual a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaDesmontajeSelect<=fechaFinFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de desmontaje de los puestos debe ser mayor o igual a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }
        return true;
    });
    
    $('#guardar').click(function(){
        var fechaIniFeriaSelect=new Date($('#fecha_inicio_feria').val());
        fechaIniFeriaSelect.setDate(fechaIniFeriaSelect.getDate()+1);
        var fechaFinFeriaSelect=new Date($('#fecha_fin_feria').val());
        fechaFinFeriaSelect.setDate(fechaFinFeriaSelect.getDate()+1);
        
        var fechaIniInscripcionSelect=new Date($('#fecha_inicio_inscripciones').val());
        fechaIniInscripcionSelect.setDate(fechaIniInscripcionSelect.getDate()+1);
        var fechaFinInscripcionSelect=new Date($('#fecha_fin_inscripciones').val());
        fechaFinInscripcionSelect.setDate(fechaFinInscripcionSelect.getDate()+1);
        
        var fechaMontajeSelect=new Date($('#fecha_montaje').val());
        fechaMontajeSelect.setDate(fechaMontajeSelect.getDate()+1);
        var fechaDesmontajeSelect=new Date($('#fecha_desmontaje').val());
        fechaDesmontajeSelect.setDate(fechaDesmontajeSelect.getDate()+1);
        
        if(fechaIniInscripcionSelect>fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de inicio de inscripciones debe ser menor a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaFinInscripcionSelect>=fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de fin de inscripciones debe ser menor o igual a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaIniInscripcionSelect>fechaFinInscripcionSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de inicio de inscripciones debe ser menor a la fecha de fin de las mismas");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaFinFeriaSelect<fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de fin de la feria debe ser mayor o igual a su fecha de inicio");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaMontajeSelect>fechaDesmontajeSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de montaje de puestos debe ser menor a la fecha de desmontaje");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaMontajeSelect>=fechaIniFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de montaje de puestos debe ser menor o igual a la fecha de inicio de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }else if(fechaDesmontajeSelect<=fechaFinFeriaSelect){
            $( "#dialog" ).html("");
            $( "#dialog" ).append("La fecha de desmontaje de los puestos debe ser mayor o igual a la fecha de fin de la feria");
            $( "#dialog" ).dialog("open");
            return false;
        }
    });
    
});



