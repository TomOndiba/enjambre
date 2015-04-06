

function confirmar(href) {


    $("#dialog-confirm").dialog({
        resizable: false,
        height: 170,
        modal: true,
        buttons: {
            "Si": function() {
                location.href = href;
            },
            No: function() {
                $(this).dialog("close");
            }
        }
    });
}

function confirmarDesactivar(href) {


    $("#dialog-confirm-desactivar").dialog({
        resizable: false,
        height: 170,
        modal: true,
        buttons: {
            "Si": function() {
                location.href = href;
            },
            No: function() {
                $(this).dialog("close");
            }
        }
    });
}

function confirmarDesactivarEstudiante(href) {
    $("#dialog-confirm-desactivar-integrante").dialog({
        resizable: false,
        height: 170,
        modal: true,
        buttons: {
            "Si": function() {
                location.href = href;
            },
            No: function() {
                $(this).dialog("close");
            }
        }
    });
}

function confirmarEliminarEstudiante(href) {
    $("#dialog-confirm-eliminar-estudiante").dialog({
        resizable: false,
        height: 170,
        modal: true,
        buttons: {
            "Si": function() {
                location.href = href;
            },
            No: function() {
                $(this).dialog("close");
            }
        }
    });
}
function editar(id) {
    location.href = '/elgg2/grupo_investigacion/editar/' + id;
}

function crearLinea(id) {
    location.href = '/elgg2/grupo_investigacion/crear_linea/' + id;
}

function verLinea(id) {
    location.href = '/elgg2/grupo_investigacion/ver_lineas/' + id;
}

function join(id, nomb) {
    location.href = '/elgg2/grupo_investigacion/join/' + id + "/" + nomb;
}

function verSolicitudes(id) {
    location.href = '/elgg2/grupo_investigacion/solicitudes/' + id;
}

function aceptarMiembro(id_usu, id_grup) {

    location.href = '/elgg2/grupo_investigacion/aceptar_miembro/true/' + id_usu + "/" + id_grup;
}

function rechazarMiembro(id_usu, id_grup) {

    location.href = '/elgg2/grupo_investigacion/aceptar_miembro/false/' + id_usu + "/" + id_grup;
}