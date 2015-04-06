$(document).ready(function() {

    $('.asignar-asesor').live('click', function() {
        
        $("#dialog").dialog({
            autoOpen: false, // no abrir automáticamente
            resizable: true, //permite cambiar el tamaño
            height: 230, // altura
            modal: true, //capa principal, fondo opaco
        });
        
        $('#dialog').dialog('open');
        var asesor = $(this).attr('title');
        var investigacion = $(this).attr('id');
        var convocatoria = $('#convocatoria').val();
        $('#dialog').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
        elgg.get('ajax/view/investigaciones/seleccionadas/asesores/agregar_asesor', {
            timeout: 30000,
            data: {
                ajax: 0,
                investigacion: investigacion,
                asesor: asesor,
                convocatoria: convocatoria,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#dialog').html(result);
            },
        });
    })
});