
$(document).ready(function() {
    $(".link").live('click',function(evento) {
        var idElemento = $(this).attr('id');
        elgg.get('ajax/view/grupo_investigacion/roles/lista_select', {
            timeout: 30000,
            data: {
                id: idElemento,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#select-rol-'+idElemento).html(result);
            },
        });
    });
    
    $("#asignar-rol-grupo").live('click',function(evento) {
        var idElemento = $(this).attr('name');
        var grupo=$("#idGrupo").val();
        var rol=$("#select-"+idElemento).val();
        var rolAntiguo=$('#select-rol-'+idElemento).attr('class');
        elgg.get('ajax/view/grupo_investigacion/roles/asignar_rol_grupo', {
            timeout: 30000,
            data: {
                id_user: idElemento,
                id_grupo:grupo,
                id_rol:rol,
                id_rol_antiguo:rolAntiguo,
                ajax:1,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#tabla').html(result);
            },
        });
    });
});

