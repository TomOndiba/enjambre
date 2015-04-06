/* 
 * Libreria JavaScript para controlar las transiciones de la barra de estado
 * 
 * 
 */

$(document).ready(function(){
    $('#comentar').show();
});
function mostrarComentario(){
    $('#comentar').show();
    $('#foto').hide();
    $('#poll').hide();
}

function mostrarFoto(){
    $('#foto').show();
    $('#comentar').hide();
    $('#poll').hide();
}

function mostrarEncuesta(){
    $('#foto').hide();
    $('#comentar').hide();
    $('#poll').show();
}


