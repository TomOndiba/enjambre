$(document).ready(function() {
    $("#bitacora-1").live("click", function() {
        $(".bitacoras").animate({left: "0px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-2").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-3").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-2").live("click", function() {
        var ancho = $("#bitacora1").width();
        $(".bitacoras").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-1").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-3").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-3").live("click", function() {
        var ancho = ($("#bitacora1").width()) * 2;
        $(".bitacoras").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-1").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-2").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });

    $("#bitacora-4").live("click", function() {
        $(".bitacoras-etapa-2").animate({left: "0px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-5").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-51").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-52").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-6").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-5").live("click", function() {
        var ancho = $("#bitacora4").width();
        $(".bitacoras-etapa-2").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-4").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-52").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-51").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-6").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-51").live("click", function() {
        var ancho = ($("#bitacora4").width()) * 2;
        $(".bitacoras-etapa-2").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-4").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-5").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-52").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-6").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-52").live("click", function() {
        var ancho = ($("#bitacora4").width()) * 3;
        $(".bitacoras-etapa-2").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-4").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-5").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-51").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-6").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-62").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-6").live("click", function() {
        var ancho = ($("#bitacora4").width()) * 4;
        $(".bitacoras-etapa-2").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-4").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-5").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-51").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-52").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-62").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-61").live("click", function() {
        var ancho = ($("#bitacora4").width()) * 5;
        $(".bitacoras-etapa-2").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-4").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-5").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-51").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-6").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-62").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-52").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#bitacora-62").live("click", function() {
        var ancho = ($("#bitacora4").width()) * 6;
        $(".bitacoras-etapa-2").animate({left: "-" + ancho + "px", position: "relative"}, "slow");
        $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $("#bitacora-4").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-5").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-51").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-6").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-61").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
        $("#bitacora-52").animate({backgroundColor: 'rgb(255,255,255)'}, "slow");
    });
    $("#etapa1").live("click", function() {
        var investigacion = $("#id_inv").val();
        elgg.get('ajax/view/etapa/etapa1', {
            timeout: 30000,
            data: {
                investigacion: investigacion,
            },
            success: function(result, success, xhr) {
                $('.pop-up-contenedor').html(result);
                cargarBitacoras(investigacion);
                animarPopUp();
            },
        });
    });

    $("#etapa2").live("click", function() {
        var investigacion = $("#id_inv").val(); 
        elgg.get('ajax/view/etapa/etapa2', {
            timeout: 30000,
            data: {
                investigacion: investigacion,
            },
            success: function(result, success, xhr) {
                $('.pop-up-contenedor').html(result);
                cargarBitacoras2(investigacion);
                animarPopUp();
            },
        });
    });

    $("#etapa3").live("click", function() {
        var investigacion = $("#id_inv").val();
        elgg.get('ajax/view/etapa/etapa3', {
            timeout: 30000,
            data: {
                investigacion: investigacion,
            },
            success: function(result, success, xhr) {
                $('.pop-up-contenedor').html(result);
                cargarBitacoras3(investigacion);
                animarPopUp();
            },
        });
    });

    $("#etapa4").live("click", function() {
        var investigacion = $("#id_inv").val();
        elgg.get('ajax/view/etapa/etapa4', {
            timeout: 30000,
            data: {
                investigacion: investigacion,
            },
            success: function(result, success, xhr) {
                $('.pop-up-contenedor').html(result);
                cargarBitacoras4(investigacion);
                animarPopUp();
            },
        });
    });

});
$(document).keyup(function(e) {
    if (e.which == 27) {
        $('.pop-up-contenedor').hide();
        $('.pop-up-contenedor').css({
            top: "25%",
            left: "25%",
            width: "50%",
            height: "50%",
            opacity: 0.7,
        })


    }
    ;
});
function animarPopUp() {
    $('.pop-up-contenedor').show().animate({
        opacity: 1,
        left: "1%",
        top: "1%",
        width: "98%",
        height: "98%",
    }, 400, function() {
        // Animation complete.
    });
}


function cargarBitacoras(guid) {
    elgg.get('ajax/view/etapa/bitacoras_etapa1', {
        timeout: 30000,
        data: {
            guid_inv: guid,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            //animarPopUp();
        },
    });
}

function cargarBitacoras2(guid) {
    var id_inv = $('#id_inv').val();
    elgg.get('ajax/view/etapa/bitacoras_etapa2', {
        timeout: 30000,
        data: {
            guid_inv: guid,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            //animarPopUp();
        },
    });
}

function cargarBitacoras3(guid) {
    var id_inv = $('#id_inv').val();
    elgg.get('ajax/view/etapa/bitacoras_etapa3', {
        timeout: 30000,
        data: {
            guid_inv: guid,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            //animarPopUp();
        },
    });
}

function cargarBitacoras4(guid) {
    var id_inv = $('#id_inv').val();
    elgg.get('ajax/view/etapa/bitacoras_etapa4', {
        timeout: 30000,
        data: {
            guid_inv: guid,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            //animarPopUp();
        },
    });
}


function cargarComponentes(etapa, componente, investigacion) {
    $(".titulo-componente").animate({marginTop: "-120px", marginBottom: "150px", position: "relative"}, "slow");
    elgg.get('ajax/view/componente/' + componente, {
        timeout: 30000,
        data: {
            etapa: etapa,
            categoria: componente,
            investigacion: investigacion,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            $(".titulo-componente").animate({marginTop: "30px", marginBottom: "0px", position: "relative"}, "slow");
            if (componente == "evaluacion") {
                cargarCalificables();
            }
        },
    });
}
function cargarComponentes2(etapa, componente, investigacion, tipo) {
    $(".titulo-componente").animate({marginTop: "-120px", marginBottom: "150px", position: "relative"}, "slow");
    elgg.get('ajax/view/componente/' + componente, {
        timeout: 30000,
        data: {
            etapa: etapa,
            categoria: componente,
            investigacion: investigacion,
            tipo: tipo,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            $(".titulo-componente").animate({marginTop: "30px", marginBottom: "0px", position: "relative"}, "slow");
            if (componente == "evaluacion") {
                cargarCalificables();
            }
        },
    });
}





function cargarCalificables() {

    $(".calificable").jRating({
        onClick: function(element, rate) {
            var asesoria = $(element).attr('title');
            var calificacion = agregarCalificacion(rate, asesoria);
            $(element).attr('data-average', calificacion);
        }});
    $(".no-editable").jRating({
        isDisabled: true
    });
}

function agregarCalificacion(rate, asesoria) {
    var nota;
    elgg.get('ajax/view/calificacion/calificar_asesoria', {
        async: false,
        data: {
            asesoria: asesoria,
            rate: rate
        },
        success: function(result, success, xhr) {
            nota = result;
        },
    });
    return nota;
}
function editarBitacora(guid) {
    elgg.get('ajax/view/bitacoras/edit', {
        timeout: 30000,
        data: {
            guid: guid

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

function verAnotacionHistorial(guid, page) {
    elgg.get('ajax/view/bitacoras/ver_anotacion_historial', {
        timeout: 30000,
        data: {
            anotacion: guid,
            bitacora: page
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
        },
    });
}


function mandarForm(form, url, categoria, etapa, investigacion) {
    var formData = new FormData($(".formulario")[0]);
    //información del formulario
    var message = "";
    //hacemos la petición ajax  
    $.ajax({
        url: url,
        type: 'POST',
        // Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        success: function(result, success, xhr) {
            cargarComponentes(etapa, categoria, investigacion);
            $(".titulo-componente").animate({marginTop: "30px", marginBottom: "0px", position: "relative"}, "slow");
        },
    });
}
function mandarFormArchivo(form, url, categoria, etapa, investigacion) {
    var formData = new FormData($(".formulario-archivo")[0]);
    //información del formulario
    var message = "";
    //hacemos la petición ajax  
    $.ajax({
        url: url,
        type: 'POST',
        // Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        success: function(result, success, xhr) {
            cargarComponentes(etapa, categoria, investigacion);
            $(".titulo-componente").animate({marginTop: "30px", marginBottom: "0px", position: "relative"}, "slow");
        },
    });
}

function mostrarForm(form) {
    if ($("#input-file").attr('title') != "no") {
        $("#input-file").customFileInput();
        $("#input-file").attr('title', 'no');
    }
    if ($("#input-file-2").attr('title') != "no") {
        $("#input-file-2").customFileInput();
        $("#input-file-2").attr('title', 'no');
    }
    if (form == "form-crear-componente") {
        if ($("#" + form).is(':visible')) {
            $("#" + form).hide();
        } else {
            $("#form-crear-archivo").hide();
            $("#" + form).show();
        }
    } else {
        if ($("#" + form).is(':visible')) {
            $("#" + form).hide();
        } else {
            $("#form-crear-componente").hide();
            $("#" + form).show();
        }
    }


}

/**
* Fiuncion que carga una vista en la bitacora 4 para crear una nueva actividad.
* @param -> bitacora -> id de la bitacora
* @param -> investigacion -> id de la investigacion
* @param -> grupo -> id del grupo de investigacion
*/
function cargarCrearActividad(bitacora, investigacion, grupo) {
    var actividad = $("#actividad-crear").val();
    elgg.get('ajax/view/bitacoras/bitacora4/crear_actividad', {
        timeout: 30000,
        data: {
            bitacora: bitacora,
            inv: investigacion,
            grupo: grupo,
            act: actividad
        },
        success: function(result, success, xhr) {
            $('#form-crear-actividad-bit4').html(result);
            $('#boton-agregar-actividad-bit4').hide();
        },
    });
}

function cargarEditarActividad(bitacora, investigacion, grupo, actividad) {
    
    elgg.get('ajax/view/bitacoras/bitacora4/crear_actividad', {
        timeout: 30000,
        data: {
            bitacora: bitacora,
            inv: investigacion,
            grupo: grupo,
            act: actividad
        },
        success: function(result, success, xhr) {
            $('#form-crear-actividad-bit4').html(result);
            $('#boton-agregar-actividad-bit4').hide();

        },
    });
}

/**
 * Función que carga el formulario para editar la información del rubro bitacora 5.1
 * @param {int} bitacora -> guid de la bitacora 5
 * @param {int} tray -> guid del trayecto de la bitacora 5
 * @param {int} item -> item del trayecto de la bitacora 5
 * @returns {undefined}
 */
function cargarEditarRubro51(bitacora, tray, item, investigacion) {
    elgg.get('ajax/view/bitacoras/bitacora5_1/crear_rubro', {
        timeout: 30000,
        data: {
            bitacora: bitacora,
            tray: tray,
            item: item,
            inv: investigacion
        },
        success: function(result, success, xhr) {
            $('#crear-rubro-bit51').html(result);
            //$('#boton-agregar-rubro-bit52').hide();
        },
    });
}

/**
 * Funcion que redirecciona a la vista del formulario para crear un item de la bitacora 5
 * @param {type} bitacora -> id de la bitacora 5 donde se guardaran los items
 * @returns 
 */
function cargarCrearItemBit5(bitacora) {
    elgg.get('ajax/view/bitacoras/bitacora5_1/crear_rubro', {
        timeout: 30000,
        data: {
            bitacora: bitacora
        },
        success: function(result, success, xhr) {
            $('#form-crear-rubro-bit51').html(result);
            $('#boton-agregar-rubro-bit51').hide();
        },
    });
}

/**
 * Función que carga el formulario para crear un rubro de la bitacora 5.2
 * @param {type} bitacora -> guid de la bitacora 5.2 que se esta guardando
 * @returns {undefined}
 */
function cargarCrearRubro2(bitacora, tray, bit51) {
    elgg.get('ajax/view/bitacoras/bitacora5_2/crear_rubro', {
        timeout: 30000,
        data: {
            bitacora: bitacora
        },
        success: function(result, success, xhr) {
            $('#form-crear-rubro-bit52').html(result);
            //$('#boton-agregar-rubro-bit52').hide();
        },
    });
}

/**
 * Función que carga el formulario de crera un item en un trayecto de la bitacora 5
 * @param {int} bitacora -> guid d ela bitacora 5 que se esta guardando
 * @param {int} trayecto -> guid del trayecto en el que se crea el item
 * @returns {undefined} 
 */
function cargarCrearItemTrayecto(bitacora, trayecto, item, investigacion, grupo) {
    elgg.get('ajax/view/bitacoras/bitacora5/crear_item_bit5', {
        timeout: 30000,
        data: {
            bit5: bitacora,
            tray: trayecto,
            inv: investigacion,
            item: item,
            grupo: grupo
        },
        success: function(result, success, xhr) {
            $('#crear-tray-bit5').html(result);
            //$('#boton-agregar-itembit5').hide();
        },
    });
}
/**
 * Funcion que llama a la vista ajax para guardar la informacion de un nuevo item en la bitacora 5
 * @param {int} item -> guid del item a eliminar
 * @param {int} bit -> guid de la biracora5
 * @returns {undefined}
 */
function eliminarItemTrayBit5(item, bit, investigacion, grupo) {
    var item = item;
    var bit = bit;
    elgg.get('ajax/view/bitacoras/bitacora5/eliminar_item_bit5', {
        timeout: 30000,
        data: {
            bit: bit,
            item: item,
            inv: investigacion,
            grupo: grupo
        },
        success: function(result, success, xhr) {
            $("#tabla-item-bit5").html(result);
            cargarBitacora51(grupo, investigacion);
        },
    });
}

/**
 * Funcion que llama a la vista ajax para guardar la informacion de un nuevo item en la bitacora 5
 * @param {type} bitacora ->guid de la bitacora
 * @param {type} trayecto -> guid del trayecto
 * @returns {undefined}
 */
function guardarItemTray(bitacora, trayecto, investigacion, grupo) {
    var nombre = $("#nombre-act-bit5").val();
    var total_ap = $("#totalAp-bit5").val();
    var total_ds = $("#totalDs-bit5").val();
    var ejecutado = $("#ejecutado-bit5").val();
    var saldo = $("#saldo-bit5").val();
    elgg.get('ajax/view/bitacoras/bitacora5/guardar_item_bit5', {
        timeout: 30000,
        data: {
            bit: bitacora,
            tray: trayecto,
            inv: investigacion,
            nombre: nombre,
            total_ap: total_ap,
            total_ds: total_ds,
            ejecutado: ejecutado,
            saldo: saldo,
            grupo: grupo
        },
        success: function(result, success, xhr) {
            $("#tabla-item-bit5").html(result);
            $('#form-crear-componente').hide();
            $('#boton-agregar-itembit5').show();
            cargarBitacora51(grupo, investigacion);
        },
    });
}

/**
 * Funcion que llama a la vista ajax para editar la informacion de un item en la bitacora 5
 * @param {int} bitacora ->guid de la bitacora
 * @param {int} trayecto -> guid del trayecto
 * @param {int} item -> guid del itema a editar
 * @returns {undefined}
 */
function editarItemTray(bitacora, trayecto, item, investigacion, grupo) {
    var nombre = $("#nombre-act-bit5").val();
    var total_ap = $("#totalAp-bit5").val();
    var total_ds = $("#totalDs-bit5").val();
    var ejecutado = $("#ejecutado-bit5").val();
    var saldo = $("#saldo-bit5").val();
    elgg.get('ajax/view/bitacoras/bitacora5/guardar_item_bit5', {
        timeout: 30000,
        data: {
            bit: bitacora,
            tray: trayecto,
            nombre: nombre,
            total_ap: total_ap,
            total_ds: total_ds,
            ejecutado: ejecutado,
            saldo: saldo,
            item: item,
            inv: investigacion
        },
        success: function(result, success, xhr) {
            $("#tabla-item-bit5").html(result);
            $('#form-crear-componente').hide();
            $('#boton-agregar-itembit5').show();
            cargarBitacora51(grupo, investigacion);
        },
    });
}

function guardarRubro(bitacora, tray, item, investigacion) {
    var descripcion = $("#descripcion-bit51").val();
    var valorUnitario = $("#valorunitario-bit51").val();
    var valorTotalRubro = $("#valortotalrubro-bit51").val();
    var valorTotal = $("#valortotal-bit51").val();

    elgg.get('ajax/view/bitacoras/bitacora5_1/guardar_rubro', {
        timeout: 30000,
        data: {
            bit: bitacora,
            descripcion: descripcion,
            valorunitario: valorUnitario,
            valortotalrubro: valorTotalRubro,
            valortotal: valorTotal,
            tray: tray,
            item: item,
            inv: investigacion

        },
        success: function(result, success, xhr) {
            $("#tabla-rubro-bit51").html(result);
            $('#form-crear-archivo').hide();
            //$('#boton-agregar-rubro-bit51').show();
            ;
        },
    });
}

function cerrarEtapa() {
    $(".pop-up-contenedor").hide();
}

/**
 * Funcion que actualiza el contenido de la bitacora 5.1
 * @param {int} inv -> guid de la investigacion
 * @param {int} grup -> guid del grupo de investigación
 * @returns {undefined}
 */
function actualizarContBit51(inv, grup) {
    alert(inv +" "+grup);
    elgg.get('ajax/view/bitacoras/bitacora5_1/bitacora5_1', {
        timeout: 30000,
        data: {
            inv: inv,
            grup: grup

        },
        success: function(result, success, xhr) {
            $("#bitacora51").html(result);
        },
    });
}

function guardarRubro2(bitacora) {
    var nombre = $("#nombre-bit52").val();
    var fechaGasto = $("#fechagasto-bit52").val();
    var valorUnitario = $("#valorunitario-bit52").val();
    var proveedor = $("#proveedor-bit52").val();
    var valorTotal = $("#valortotal-bit52").val();
    elgg.get('ajax/view/bitacoras/bitacora5_2/guardar_rubro', {
        timeout: 30000,
        data: {
            bitacora: bitacora,
            nombre: nombre,
            fechagasto: fechaGasto,
            valorunitario: valorUnitario,
            proveedor: proveedor,
            valortotal: valorTotal
        },
        success: function(result, success, xhr) {
            $("#tabla-rubro-bit52").html(result);
            $('#form-crear-rubro-bit52').empty();
            $('#boton-agregar-rubro-bit52').show();
        },
    });
}
function eliminarRubro2(rubro, bitacora) {
    elgg.get('ajax/view/bitacoras/bitacora5_2/eliminar_rubro', {
        timeout: 30000,
        data: {
            bitacora: bitacora,
            rubro: rubro,
        },
        success: function(result, success, xhr) {
            $("#tabla-rubro-bit52").html(result);
            $('#form-crear-rubro-bit52').empty();
            $('#boton-agregar-rubro-bit52').show();
        },
    });
}

function guardarActividad(bitacora, investigacion, grupo) {
    var nombre = $("#bit4-nombre").val();
    var actividad = $("#actividad-crear").val();
    var desde = $("#bit4-desde").val();
    var hasta = $("#bit4-hasta").val();
    var responsable = $("#bit4-responsable").val();
    elgg.get('ajax/view/bitacoras/bitacora4/guardar_actividad', {
        timeout: 30000,
        data: {
            bitacora: bitacora,
            act: actividad,
            inv: investigacion,
            grupo: grupo,
            nombre: nombre,
            desde: desde,
            hasta: hasta,
            responsable: responsable
        },
        success: function(result, success, xhr) {
            $("#tabla-actividades-bit4").html(result);
            $('#form-crear-actividad-bit4').empty();
            ;
            $('#boton-agregar-actividad-bit4').show();
            ;
            cargarBitacora5(grupo, investigacion);
            cargarBitacora51(grupo, investigacion);
        },
    });
}

/**
* Funcnion que actualiza la tabla de trayectos de la bitacora 5 al guardar una actividad de la bitacora 4
*/
function cargarBitacora5(grupo, investigacion){
    elgg.get('ajax/view/bitacoras/bitacora5/bitacora5', {
        timeout: 30000,
        data: {
            investigacion: investigacion,
            grupo: grupo,
        },
        success: function(result, success, xhr) {
            $("#tabla-item-bit5").html(result);
        },
    });
}

/**
* Funcnion que actualiza la tabla de trayectos de la bitacora 5.1 al guardar una actividad de la bitacora 4
*/
function cargarBitacora51(grupo, investigacion){
    elgg.get('ajax/view/bitacoras/bitacora5_1/bitacora5_1', {
        timeout: 30000,
        data: {
            investigacion: investigacion,
            grupo: grupo,
        },
        success: function(result, success, xhr) {
            $("#tabla-rubro-bit51").html(result);
        },
    });
}
