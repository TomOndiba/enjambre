
function elgg_confirmar_elim(nombre, page) {
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


function elgg_confirmar_elim_ACT(href) {
    $("#dialog-confirm-act").dialog({
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


$(document).ready(function() {


    $("input[type='number']").live('change', (function() {

        var valor_rubro = Number($("input[id='valorunitario-bit51']").val());
        if (valor_rubro < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valorunitario-bit51").val('0');
        }
        var total = Number($("input[id='valortotal-bit51']").val());
        if (total < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valortotal-bit51").val('0');
        }
        var total_rurbo = Number($("input[id='valortotalrubro-bit51']").val());
        if (total_rurbo < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valortotalrubro-bit51").val('0');
        }


        var total_rurbo2 = Number($("input[id='valorunitario-bit52']").val());
        if (total_rurbo2 < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valorunitario-bit52").val('0');
        }
        var total_rurbo2 = Number($("input[id='valortotal-bit52']").val());
        if (total_rurbo2 < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valortotal-bit52").val('0');
        }

    }));

    $("input[type='number']").live('keyup', (function() {
        var valor_rubro = Number($("input[id='valorunitario-bit51']").val());
        if (valor_rubro < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valorunitario-bit51").val('0');
        }
        var total_rurbo = Number($("input[id='valortotalrubro-bit51']").val());
        if (total_rurbo < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valortotalrubro-bit51").val('0');
        }
        var total = Number($("input[id='valortotal-bit51']").val());
        if (total < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valortotal-bit51").val('0');
        }

        var total_rurbo2 = Number($("input[id='valorunitario-bit52']").val());
        if (total_rurbo2 < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valorunitario-bit52").val('0');
        }
        var total_rurbo2 = Number($("input[id='valortotal-bit52']").val());
        if (total_rurbo2 < 0) {
            alert('Recuerde que este campo es > 0');
            $("#valortotal-bit52").val('0');
        }
    }));
});
