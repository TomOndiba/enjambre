$(document).ready(function() {
    $("#ver-mas-notas").live("click", function() {
        var offset = $(this).attr('title');
        var cuadernoGuid = $(this).attr('name');
        var etapa=$("#etapa").val();
        $(this).remove();
        elgg.get('ajax/view/cuaderno_nota/ver_cuaderno', {
            timeout: 30000,
            data: {
                ajax: 1,
                cuaderno:cuadernoGuid,
                offset: offset,
                etapa:etapa,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#notas-ajax').html(result);
            },
        });
    });
  
    
});