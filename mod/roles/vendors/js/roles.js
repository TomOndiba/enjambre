
var idUser;
$(document).ready(function() {
    $("#enlaceajax").live("click",function(evento) {
        $('#destino').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        var id = $(this).attr('class');
        idUser = id;
        elgg.get('ajax/view/roles/asignar_roles_usuario', {
            timeout: 30000,
            data: {
                id: idUser,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#destino').html(result);
            },
        });
    });

    $("#buttonagregarrol").live('click', function(evento) {
        elgg.get('ajax/view/roles/seleccion_roles', {
            timeout: 30000,
            data: {
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#seleccion_roles').html(result);
            },
        });

    });

    $("#asignarrol").live('click', function(evento) {
        elgg.get('ajax/view/roles/guardar_rol', {
            timeout: 30000,
            data: {
                rol: $("#select_rol").val(),
                user: idUser,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#destino').html(result);
            },
        });
    });
    
    
    $("#buscar").keyup(function(){
        $('#destino').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        var nombre = $(this).val();
        if (nombre == '') {
            $('#destino').hide();
        } else {
            elgg.get('ajax/view/roles/buscar_usuario', {
                timeout: 30000,
                data: {
                    nombre_usuario: nombre
                },
                success: function(result, success, xhr) {
                    $('#destino').html(result);
                    $('#destino').show();
                },
            });
        }
        return false;
    });
});


function desasignarRol(codigoRol) {
    $('#destino').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
    elgg.get('ajax/view/roles/desasignar_rol', {
        timeout: 30000,
        data: {
            id: idUser,
            idRol: codigoRol,
            pageowner: elgg.get_page_owner_guid()
        },
        success: function(result, success, xhr) {
            $('#destino').html(result);
        },
    });
}
