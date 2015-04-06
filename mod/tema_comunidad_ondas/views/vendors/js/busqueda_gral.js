$(document).ready(function() {

    $(".busqueda").keyup(function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            var cajabusqueda = $(this).val();
            var url = $("#url_buscar").val();

            if (cajabusqueda == '') {
                
            } else {
                location.href=url+"/"+cajabusqueda;
            }
        }
    });
});