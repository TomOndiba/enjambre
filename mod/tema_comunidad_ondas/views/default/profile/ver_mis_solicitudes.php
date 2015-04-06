<?php
//

elgg_load_js('amigos');
elgg_load_js("reveal2");
elgg_load_css('reveal');


$user = $vars['user'];

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 9;
echo "<div class='box'>";
if(!$ajax) {
    echo "<div id='paginable' class='elgg-image-block clearfix'>";
    echo elgg_get_solicitudes_amigos($limit, 0, $user->guid);
    echo "</div>";
} else {
    $guid = get_input('guid');
    echo elgg_get_solicitudes_amigos($limit, $offset, $guid);
}
echo "</div>";
echo '<div style="display:none;" id="dialog-confirm-aceptar" title="Confirmación"> ¿Está seguro que deseas aceptar esta solicitud?</div>';
?>

<script>
function confirmarSolicitud(href) {
    $( "#dialog-confirm-aceptar" ).dialog({
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
</script>

