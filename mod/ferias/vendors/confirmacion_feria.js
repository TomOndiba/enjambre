function confirmar(href) {
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


