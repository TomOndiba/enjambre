$(document).ready(function() {

    $(".presupuesto").keyup(function()
    {
        var id = $(this).attr('id');
        var val = $('#' + id).val();
        if (val < 0) {
            alert('No se pueden introducir números negativos');
            $("#" + id).css('background-color', "red");
            return false;
        } else {
            $("#" + id).css('background-color', "white");
        }
        var valor = 0;
        $(".presupuesto").each(
                function(index, value) {
                    var x = eval($(this).val());
                    if (typeof x === "undefined") {
                        x = 0;
                    }
                    valor = valor + x;
                }
        );
        $("#suma").val(valor);
        var convocatoria = eval($('#total').val());
        var restante = eval(convocatoria - valor);
        $("#restante").val(restante);

        if (restante < 0) {
            $("#restante").css('background-color', "red");
        } else {
            $("#restante").css('background-color', "white");
        }
    });

    $(".presupuesto").change(function()
    {

        var id = $(this).attr('id');
        var val = $('#' + id).val();
        if (val < 0) {
            alert('No se pueden introducir números negativos');
            $("#" + id).css('background-color', "red");
            return false;
        } else {
            $("#" + id).css('background-color', "white");
        }

        var valor = 0;
        $(".presupuesto").each(
                function(index, value) {
                    var x = eval($(this).val());
                    if (typeof x === "undefined") {
                        x = 0;
                    }
                    valor = valor + x;
                }
        );
        $("#suma").val(valor);
        var convocatoria = eval($('#total').val());
        var restante = eval(convocatoria - valor);
        $("#restante").val(restante);

        if (restante < 0) {
            $("#restante").css('background-color', "red");
        } else {
            $("#restante").css('background-color', "white");
        }

    });

    $('#valor_todos').keyup(function(e)
    {
        var val = $(this).val();
        if (val < 0) {

        } else {
            $('#valor_todos').css('background-color', "white");
        }
    });

    $('#valor_todos').change(function()
    {
        var val = $(this).val();
        if (val < 0) {

        } else {
            $('#valor_todos').css('background-color', "white");
        }
    });


    $("#presupuesto_todos").click(function()
    {
        var val = $('#valor_todos').val();
        if (val < 0) {
            alert('No se pueden introducir números negativos');
            $('#valor_todos').css('background-color', "red");
            return false;
        } else {
            $('#valor_todos').css('background-color', "white");
        }

        $("#dialog-confirm").dialog({
            resizable: false,
            height: 170,
            modal: true,
            buttons: {
                "Si": function() {
                    $('.presupuesto').val(val);

                    var valor = 0;
                    $(".presupuesto").each(
                            function(index, value) {
                                var x = eval($(this).val());
                                if (typeof x === "undefined") {
                                    x = 0;
                                }
                                valor = valor + x;
                            }
                    );
                    $("#suma").val(valor);
                    var convocatoria = eval($('#total').val());
                    var restante = eval(convocatoria - valor);
                    $("#restante").val(restante);

                    if (restante < 0) {
                        $("#restante").css('background-color', "red");
                    } else {
                        $("#restante").css('background-color', "white");
                    }
                    $(this).dialog("close");
                },
                No: function() {
                    $(this).dialog("close");
                }
            }
        });

    });

    $("#dialog").dialog({
        autoOpen: false, // no abrir automáticamente
        resizable: true, //permite cambiar el tamaño
        height: 220, // altura
        modal: true, //capa principal, fondo opaco
        buttons: {//crear botón de cerrar
            "Cerrar": function() {
                $(this).dialog("close");
            }
        }
    });

    $('#guardar').click(function() {
        var sw = true;
        $(".presupuesto").each(
                function(index, value) {
                    var x = eval($(this).val());
                    var id = $(this).attr('id');
                    if (x < 0) {
                        $("#" + id).css('background-color', "red");
                        alert('No se pueden introducir números negativos');
                        sw = sw && false;
                    } else {
                        $("#" + id).css('background-color', "white");
                    }
                }
        );

        if (!sw) {
            return false;
        }

        var restante = eval($('#restante').val());
        if (restante < 0) {
            $("#dialog").html("");
            $("#dialog").append("El presupuesto asignado a las investigaciones excede el presupuesto de la convocatoria");
            $("#dialog").dialog("open");
            return false;
        }
        return true;
    });

});