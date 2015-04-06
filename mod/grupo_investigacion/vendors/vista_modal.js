$(document).ready(function(){

    $( "#dialog" ).dialog({
        autoOpen: false, // no abrir automáticamente
        resizable: true, //permite cambiar el tamaño
        height:230, // altura
        modal: true, //capa principal, fondo opaco
    });
    
    $('#categoria').click(function(){
        $('#dialog').dialog('open');
    })
    
     $( "#dialog1" ).dialog({
        autoOpen: false, // no abrir automáticamente
        resizable: true, //permite cambiar el tamaño
        height:130, // altura
        modal: true, //capa principal, fondo opaco
    });
});

function validar(categoria, guid, guid_inv, url){
    
    var guid=guid;
    var guid_inv=guid_inv;
    
    if(categoria==''){
        $('#dialog1').dialog('open');
//        $('#myModalConvocatorias').hide();
    }else{
        //location.href=url;
        elgg.get(url, {
            timeout: 30000,
            data: {
                id_grupo:guid,
                id_inv:guid_inv,         
            },
            success: function(result, success, xhr) {
                $('.pop-up-convocatorias').html(result);
            },
        });
    }
    
}

function categoria(value, guid, guid_inv, url){
    
    var guid=guid;
    var guid_inv=guid_inv;
    
        elgg.get(url, {
            timeout: 30000,
            data: {
                id_grupo:guid,
                id_inv:guid_inv, 
                value:value,
            },
            success: function(result, success, xhr) {
                $('.pop-up-convocatorias').html(result);
            },
        });
    
}


