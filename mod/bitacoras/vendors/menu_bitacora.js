

function editarBitacora(guid) {
    elgg.get('ajax/view/bitacoras/edit', {
        timeout: 30000,
        data: {
            guid: guid,
            
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
        },
    });
}

function verHistorial(guid) {
    elgg.get('ajax/view/bitacoras/history', {
        timeout: 30000,
        data: {
            guid: guid
            
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
        },
    });
}
