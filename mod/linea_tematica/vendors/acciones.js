function elgg_delete_lineatematica(id, nomb){
    location.href= '/elgg/linea/delete/'+id+"/"+nomb;
}

function elgg_confirmar_elim(href) {
        $( "#dialog-confirm" ).dialog({
          resizable: false,
          height:170,
          modal: true,
          buttons: {
            "Si": function() {
              location.href=href;
            },
            No: function() {
              $( this ).dialog( "close" );
            }
          }
        });
    }
    
