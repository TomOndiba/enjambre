$(document).ready(function() {

    $(".buscar-integrante").live('keyup', function()
    {
        $('#display').html('<div class="elgg-ajax-loader" style="height:100px;"></div>').show();
        var cajabusqueda = $(this).val();
        var dataString = cajabusqueda;
        var id_grupo = document.getElementById('id_grupo').value;
        var id_cuad = document.getElementById('id_cuad').value;
        if (cajabusqueda == '') {
            $('#display').hide();
        } else {

            elgg.get('ajax/view/cuaderno_campo/mostrar_integrantes', {
                timeout: 30000,
                data: {
                    id: dataString,
                    id_grupo: id_grupo,
                    id_cuad: id_cuad,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#display').html(result);
                    $('#display').show();
                },
            });
        }
        return false;
    });

});




