<?php
elgg_load_js('confirmacion');
elgg_load_js('fullcalendar');
elgg_load_css("fullcalendar_css");
elgg_load_js("timer");
elgg_load_js('validate');

elgg_load_js("reveal2");
elgg_load_css('reveal');
$guid = $vars['guid'];
$json_data = elgg_get_json_eventos_red($guid);
$site_url = elgg_get_site_url();
$entity = get_entity($guid);
$user = elgg_get_logged_in_user_guid();
if (elgg_is_miembro_admin($guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $guid)) {
    $header.="<div class='contenedor-button'>";
    $header.= '<a class="link-button" href="#" data-reveal-id="myModal" onclick=\' getCrearEvento("' . $guid . '")  \'>Crear Evento</a> ';
    $header.="</div>";
}
//$listaBread = array(array('titulo' => elgg_echo('calendario'), 'url' => "{$site_url}grupo_investigacion/ver/{$guid}/calendario"));
//$lista = array('bread' => $listaBread);
//$breadcrumbs = elgg_view('breadcrumbs_generar', $lista);
?>

<script>
    $(document).ready(function() {
        $('#info-evento').hide(),
                $('#calendar').fullCalendar({
            height: 450,
            width: 500,
            events:
<?php echo $json_data ?>,
            eventClick: function(calEvent, jsEvent, view) {
                pintarEvento(calEvent.id, jsEvent);
            }

        });

    });



    function pintarEvento(id, jsEvent) {
        var modalLocation = "myModalEv";
        $('#' + modalLocation).reveal($(this).data());
        elgg.get('ajax/view/redes_tematicas/calendario/ver_evento', {
            timeout: 30000,
            data: {
                guid_evento: id,
            },
            success: function(result, success, xhr) {
                $('#ver-info-evento').html(result);
            },
        });
    }
</script>


<div id="myModalEv" class="reveal-modal">
    <div class="close-reveal-modal cierre-eventos"></div>
    <div class="pop-up-calendar pop-up">
        <!--<div><a href="" class="bottom-bar">Eliminar</a></div>-->
        <!--<div><a href="" class="link-button">Editar</a></div>-->
        <div id='ver-info-evento'></div>
    </div>
</div>

<script>
    function getCrearEvento(guid) {
        var owner = guid;
        elgg.get('ajax/view/grupo_investigacion/calendario/crear_evento', {
            timeout: 30000,
            data: {
                owner: owner,
            },
            success: function(result, success, xhr) {
                $('#form-crear-evento').html(result);
            },
        });
    }
</script>


<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-archivos pop-up" id="form-crear-evento">

    </div>
</div>
<script>
    function getCrearEvento(guid) {
        var owner = guid;
        elgg.get('ajax/view/grupo_investigacion/calendario/crear_evento', {
            timeout: 30000,
            data: {
                owner: owner,
            },
            success: function(result, success, xhr) {
                $('.pop-up-archivos').html(result);
            },
        });
    }
</script>

<div class='box contet-grupo-investigacion'><div class='padding20'>
        <h2 class="title-legend">Calendario</h2>
        <?php echo $breadcrumbs . $header ?>
        <div id='calendar'></div>

        <div id='info-evento'>

        </div>

    </div></div>

