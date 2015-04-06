
$(document).ready(function() {


    sumar();
    $('.suma').live('keyup',function(e) {


        var suma = eval($(this).val());
        var key = e.which;
        try {

            if (key != 8) {
                if (suma <= 10) {
                }
                else if (key != 9) {
                    $(this).val('');
                }

            }

            sumar();
        }
        catch (err)
        {
            $(this).val('');
        }
    });
    
     $('.suma').live("change", function(e) {


        var suma = eval($(this).val());
        var key = e.which;
        try {

            if (key != 8) {
                if (suma <= 10) {
                }
                else if (key != 9) {
                    $(this).val('');
                }

            }

            sumar();
        }
        catch (err)
        {
            $(this).val('');
        }
    });
});
function sumar() {
    var valor = 0;
    $(".suma").each(
            function(index, value) {
                var x = eval($(this).val());
                if (typeof x === "undefined") {
                    x = 0;
                }
                valor = valor + x;
            }
    );
    $("#resultado").val(valor);
    if (valor >= 18) {
        $("#concepto").val('Aprobado');
    } else {
        $("#concepto").val('Rechazado');
    }
}


