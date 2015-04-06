


function cargarcampos(){
   
    $('#maestro').hide('slow');
    $('#seleccion').change(function() { 
        var selectorActive = $(this).val();
        if(selectorActive==='Estudiante'){
            $('#estudiante').show('slow');
            $('#maestro').hide('slow');
        }
        
        else{
            $('#estudiante').hide('slow');
            $('#maestro').show('slow');
        }
    });

}
