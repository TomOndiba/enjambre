/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $('.detalles-visitas').hide();
    $('.ocultar').hide();
});
function ver_detalles(id_visita){
    //$('observaciones_'+id_visita).slideDown();
    $('#observaciones_'+id_visita).show("slow");
    $('#ocultar_'+id_visita).show();
    $('#mostrar_'+id_visita).hide();
}
function ocultar_detalles(id_visita){
    $('#observaciones_'+id_visita).hide("slow");
    $('#ocultar_'+id_visita).hide();
    $('#mostrar_'+id_visita).show();
}


