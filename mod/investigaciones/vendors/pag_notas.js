var busqueda = 0;
var tipo = "Actividades/Sucesos";
alert("llega");

$(document).ready(function() {
    alert("llega2");
       $("#ver-mas-notas").live("click", function() {
           alert("llega3");
        var offset = $(this).attr('title');
        var guid = $(this).attr('name');
        var etapa=$("#etapa").val();
        alert(guid+" "+etapa+" "+tipo);
        $(this).remove();
        elgg.get('ajax/view/diario_campo/ver_diario', {
            timeout: 30000,
            data: {
                ajax: 1,
                guid:guid,
                offset: offset,
                tipo:tipo,
                etapa:etapa,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#notas-ajax').html(result);
            },
        });
    });
    
});


$(document).ready(function() {
    
   
    var src = String(window.location.href);
    var dire = src.split("#")[1];
    if (dire === undefined) {
   
            categoria = "Actividades/Sucesos";
            cargarNotas("Actividades/Sucesos");
      
    }
    else {
        cargarNotas(dire);
    }



 
   
  
     $(".ver-lista-archivos").live('click', function(evento) {
     
           tipo = $(this).attr('name');
        var grupo = $(this).attr('title');
        var etapa = $("#etapa").val();
        var offset = 0;
        $(this).remove();
        $("#ver-mas-notas").live("click", function() {
        elgg.get('ajax/view/diario_campo/ver_diario', {
            timeout: 30000,
            data: {
                ajax: 1,
                guid:guid,
                offset: offset,
                tipo:tipo,
                etapa:etapa,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#notas-ajax').html(result);
                $(".elgg-state-selected").removeClass('elgg-state-selected');
                $("#" + tipo).addClass("elgg-state-selected");
            },
        });
    
     });
 });
});



function cargarNotas(dir) {
    
    
    tipo = dir.replace("_", " ");
    tipo = tipo.replace("_", " ");
  
   $("#ver-mas-notas").live("click", function() {
        var etapa = $("#etapa").val();
        var id= $("#falta").val();
        $(this).remove();
        elgg.get('ajax/view/diario_campo/ver_diario', {
            timeout: 30000,
            data: {
                offset:0,
                ajax: 1,
                guid:id,
                tipo:tipo,
                etapa:etapa,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#notas-ajax').html(result);
            },
        });
    });


}




